<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 23:41
 */

namespace AnaN\Tree;


use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;

abstract class AbstractDerivableNode implements DerivableNodeInterface
{

	protected static $precedence = 0;

	/**
	 * @param array ...$values
	 * @return AdditionNode
	 */
	public function add(... $values)
	{
		array_unshift($values, $this);
		return Tree::add(... $values);
	}

	/**
	 * @param $value
	 * @return BinaryMultiplicationNode
	 */
	public function mult($value)
	{
		return Tree::mult($this, $value);
	}

	/**
	 * @param $value
	 * @return PowerNode
	 */
	public function pow($value)
	{
		return Tree::pow($this, $value);
	}

	public function getPrecedence()
	{
		return static::$precedence;
	}

}