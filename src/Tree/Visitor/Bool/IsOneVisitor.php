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

class IsOneVisitor extends BooleanVisitor
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
		return $this->_evalIsOne($node);
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{

		return $this->_evalIsOne($node);

	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{

		return $this->_evalIsOne($node);
	}

	public function visitPowerNode(PowerNode $node)
	{
		if ($this->_evalIsZero($node->getExponent())) {
			return true;
		}

		return $this->_evalIsOne($node);
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $this->_evalIsOne($node);
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return $this->_evalIsOne($node);
	}

	/**
	 * @param NodeInterface $node
	 * @return bool
	 */
	protected function _evalIsOne(NodeInterface $node)
	{
		try {
			return $this->evalVisitor->visit($node) == 1;
		} catch (\OutOfBoundsException $e) {
			return false;
		}
	}

	/**
	 * @param NodeInterface $node
	 * @return bool
	 */
	protected function _evalIsZero(NodeInterface $node)
	{
		try {
			return $this->evalVisitor->visit($node) == 0;
		} catch (\OutOfBoundsException $e) {
			return false;
		}
	}
}