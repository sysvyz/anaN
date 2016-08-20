<?php namespace AnaN\Tree\Visitor\Bool;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\NodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\EvaluationVisitor;

class IsZeroVisitor extends BooleanVisitor
{
	/**
	 * @var EvaluationVisitor
	 */
	private $evalVisitor;
	public static function init(){

		static $instance ;
		if(!$instance){
			$instance = new self();
		}

		return $instance;
	}
	/**
	 * IsZeroVisitor constructor.
	 * @param EvaluationVisitor $evalVisitor
	 */
	private function __construct()
	{
		$this->evalVisitor = EvaluationVisitor::default();
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		return $this->_evalIsZero($node);
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		foreach ($node->getChildren() as $child) {
			if ($this->visit($child)) {
				return true;
			}
		}
		return $this->_evalIsZero($node);

	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{

		if (
			$this->visit($node->getA()) ||
			$this->visit($node->getB())
		) {
			return true;
		}

		return $this->_evalIsZero($node);
	}

	public function visitPowerNode(PowerNode $node)
	{
		if ($this->visit($node->getBase())) {
			return true;
		}

		return $this->_evalIsZero($node);
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $this->_evalIsZero($node);
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return $this->_evalIsZero($node);
	}

	/**
	 * @param NodeInterface $node
	 * @return bool
	 */
	public function _evalIsZero(NodeInterface $node)
	{
		try {
			return $this->evalVisitor->visit($node) == 0;
		} catch (\OutOfBoundsException $e) {
			return false;
		}
	}
}