<?php namespace AnaN\Tree\Interfaces;


use AnaN\Calculus\Derivable;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;

interface DerivableNodeInterface extends FunctionNodeInterface, Derivable
{

	public function derive(string $variableName) : Derivable;


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
	 * @return string
	 */
	public function render();

	public function getPrecedence();
}