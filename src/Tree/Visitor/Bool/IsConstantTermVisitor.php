<?php namespace AnaN\Tree\Visitor\Bool;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\NodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\Visitor\EvaluationVisitor;

class IsConstantTermVisitor extends BooleanVisitor
{

	public function visitAdditionNode(AdditionNode $node)
	{
		foreach ($node->getChildren() as $child){
			if(!$this->visit($child)){
				return false;
			}
		}
		return true;
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		foreach ($node->getChildren() as $child){
			if(!$this->visit($child)){
				return false;
			}
		}
		return true;
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{

		return $this->visit($node->getA())&&$this->visit($node->getB());
	}

	public function visitPowerNode(PowerNode $node)
	{
		return $this->visit($node->getBase())&&$this->visit($node->getExponent());
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return true;
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return false;
	}
}