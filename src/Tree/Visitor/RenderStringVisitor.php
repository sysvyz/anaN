<?php namespace AnaN\Tree\Visitor;

use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\FunctionNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;

class RenderStringVisitor extends AbstractVisitor
{
	/**
	 * @var FunctionNodeInterface
	 */
	private $parenNode;
	public static function init(){

		static $instance ;
		if(!$instance){
			$instance = new self();
		}

		return $instance;
	}
	/**
	 * RenderStringVisitor constructor.
	 * @param FunctionNodeInterface $parenNode
	 */
	private function __construct(FunctionNodeInterface $parenNode = null)
	{
		$this->parenNode = $parenNode;
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		$childVisitor = new self($node);
		return $this->_process(
			$node,
			implode(
				' + ',
				array_map(
					function (DerivableNodeInterface $childNode) use ($childVisitor) {
						return $childNode->accept($childVisitor);
					},
					$node->getChildren()
				)
			)
		);

	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		$childVisitor = new self($node);
		return $this->_process(
			$node,
			implode(
				' * ',
				array_map(
					function (DerivableNodeInterface $childNode) use ($childVisitor) {
						return $childNode->accept($childVisitor);
					},
					$node->getChildren()
				)
			)
		);
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{

		$childVisitor = new self($node);
		$a = $node->getA();
		$b = $node->getB();
		return $this->_process($node, $a->accept($childVisitor) . ' * ' . $b->accept($childVisitor));
	}

	public function visitPowerNode(PowerNode $node)
	{


		$childVisitor = new self($node);
		$base = $node->getBase();
		$exp = $node->getExponent();

		return $this->_process($node, $base->accept($childVisitor) . ' ^ ' . $exp->accept($childVisitor));
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $node->getValue();
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{

		return $node->getName();
	}

	/**
	 * @param FunctionNodeInterface $node
	 * @param string $content
	 * @return mixed
	 */
	private function _process(FunctionNodeInterface $node,string $content)
	{
		$isEmbraced = ($this->parenNode && $this->parenNode->getPrecedence() > $node->getPrecedence());
		return
			(
			$isEmbraced ? '(' : ''
			) .
			$content .
			(
			$isEmbraced ? ')' : ''
			);
	}
}