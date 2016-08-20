<?php namespace AnaN\Tree\Visitor;


use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use OutOfBoundsException;

class EvaluationVisitor extends AbstractVisitor
{
	/**
	 * @var int[]
	 */
	private $bindings = [];

	public static function default(){

		static $instance ;
		if(!$instance){
			$instance = new self();
		}

		return $instance;
	}
	/**
	 * EvaluationVisitor constructor.
	 * @param \int[] $bindings
	 */
	public function __construct(array $bindings = [])
	{
		$this->bindings = $bindings;
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		return array_sum(array_map(function (DerivableNodeInterface $child) {
			return $this->visit($child);
		}, $node->getChildren()));
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		return array_product(array_map(function (DerivableNodeInterface $child) {
			return $this->visit($child);
		}, $node->getChildren()));
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{
		return $this->visit($node->getA()) * $this->visit($node->getB());
	}

	public function visitPowerNode(PowerNode $node)
	{
		return pow($this->visit($node->getBase()), $this->visit($node->getExponent()));
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $node->getValue();
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{

		$varName = $node->getName();
		if(!isset($this->bindings[$varName])){
			throw new OutOfBoundsException($varName. ' unknown');
		}

		return $this->bindings[$varName];

	}
}