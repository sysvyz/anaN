<?php namespace AnaN\Tree\Visitor\Bool;


use AnaN\Tree\AbstractVisitor;
use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\VariableNode;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class TypeVisitor extends BooleanVisitor
{

	private $type;

	/**
	 * TypeVisitor constructor.
	 * @param $type
	 */
	public function __construct($type)
	{

		if (!class_exists($type) ||
			interface_exists($type) ||
			trait_exists($type)
		) {
			throw new InvalidArgumentException($type . ' does not exist');
		}

		$this->type = $type;
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		return $this->type == AdditionNode::class;
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		return $this->type == ArrayMultiplicationNode::class;
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{
		return $this->type == BinaryMultiplicationNode::class;
	}

	public function visitPowerNode(PowerNode $node)
	{
		return $this->type == PowerNode::class;
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $this->type == ConstantNode::class;
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return $this->type == VariableNode::class;
	}
}