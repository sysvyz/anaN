<?php namespace AnaN\Tree\Visitor\Node;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\Bool\IsOneVisitor;
use AnaN\Tree\Visitor\Bool\IsZeroVisitor;
use AnaN\Tree\Visitor\Bool\TypeVisitor;
use AnaN\Tree\Visitor\EvaluationVisitor;

class DerivationVisitor extends AbstractNodeVisitor
{
	private $variableName;

	/**
	 * DerivationVisitor constructor.
	 * @param $variableName
	 */
	public function __construct($variableName)
	{
		$this->variableName = $variableName;
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		return new AdditionNode(...array_map(function (DerivableNodeInterface $child)  {
			return $this->visit($child);
		}, $node->getChildren()));
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		$nodes = [];

		foreach ($node->getChildren() as $key => $c) {
			$cpy = $this->copy($node->getChildren());
			$cpy[$key] = $this->visit($c);
			$nodes [] = Tree::mult(...$cpy);
		}

		return Tree::add(...$nodes);
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{
		$x = new  BinaryMultiplicationNode($this->visit($node->getA()), $node->getB());
		$y = new  BinaryMultiplicationNode($node->getA(), $this->visit($node->getB()));
		return new  AdditionNode($x, $y);
	}

	public function visitPowerNode(PowerNode $node)
	{
		$exp = new AdditionNode($node->getExponent(), new ConstantNode(-1));
		$pow = new PowerNode($node->getBase(), $exp);
		return new ArrayMultiplicationNode($node->getExponent(), $pow, $this->visit($node->getBase()));
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return new ConstantNode(0);
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return new ConstantNode(1);
	}

	private function copy(array $c)
	{
		return $c;
	}
}