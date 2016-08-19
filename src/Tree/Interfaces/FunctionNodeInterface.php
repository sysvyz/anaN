<?php namespace AnaN\Tree\Interfaces;


use AnaN\Calculus\FunctionInterface;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;

interface FunctionNodeInterface extends NodeInterface, FunctionInterface
{

	/**
	 * @param array ...$values
	 * @return AdditionNode
	 */
	public function add(... $values);

	/**
	 * @param $value
	 * @return BinaryMultiplicationNode
	 */
	public function mult($value);

	/**
	 * @param $value
	 * @return PowerNode
	 */
	public function pow($value);


	/**
	 * @return int
	 */
	public function getPrecedence();
}