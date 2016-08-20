<?php namespace AnaN\Tree\Factory;


use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\VariableNode;

/**
 * @param $val
 * @return DerivableNodeInterface
 */
function getNode($val)
{

	if (is_numeric($val)) {
		return new ConstantNode($val);
	}
	if (is_string($val)) {
		return new VariableNode($val);
	}
	if ($val instanceof DerivableNodeInterface) {
		return $val;
	}
}

/**
 * @param array ...$vals
 * @return AdditionNode
 */
function add(... $vals)
{
	return new AdditionNode(... array_map('AnaN\Tree\Factory\getNode', $vals));

}

/**
 * @param array ...$vals
 * @return ArrayMultiplicationNode
 */
function mult(... $vals)
{
	return new ArrayMultiplicationNode(... array_map('AnaN\Tree\Factory\getNode', $vals));

}

/**
 * @param array ...$vals
 * @return PowerNode
 */
function pow(... $vals)
{
	return new PowerNode(... array_map('AnaN\Tree\Factory\getNode', $vals));

}

final class Tree
{
	/**
	 * @param $val
	 * @return DerivableNodeInterface
	 */
	public static function init($val)
	{
		return getNode($val);
	}

	/**
	 * Tree constructor.
	 */
	private function __construct()
	{
	}

	/**
	 * @param array ...$vals
	 * @return AdditionNode
	 */
	public static function add(... $vals)
	{

		return add(... $vals);
	}

	/**
	 * @param array ...$vals
	 * @return ArrayMultiplicationNode
	 */
	public static function mult(... $vals)
	{

		return mult(... $vals);
	}

	/**
	 * @param array ...$vals
	 * @return PowerNode
	 */
	public static function pow(... $vals)
	{
		return pow(... $vals);
	}
}