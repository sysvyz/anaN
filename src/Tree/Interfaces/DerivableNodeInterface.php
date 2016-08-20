<?php namespace AnaN\Tree\Interfaces;


use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use Tree\AbstractVisitor;

interface DerivableNodeInterface extends FunctionNodeInterface
{


	/**
	 * @return int
	 */
	public function getPrecedence();





}