<?php namespace AnaN\Tree\Visitor;

use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;

class XMLVisitor extends AbstractVisitor
{
	public static function init()
	{
		static $instance;
		if (!$instance) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * @var static
	 */
	private $depth;

	private function __construct(int $depth = 0)
	{
		$this->depth = $depth;
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		return $this->_renderNode($this->_indent($this->depth+1) . '<addition>' . PHP_EOL . implode(PHP_EOL, array_map(function (DerivableNodeInterface $child) {
				$v = new XMLVisitor($this->depth + 2);
				return $v->visit($child);
			}, $node->getChildren())) . PHP_EOL . $this->_indent($this->depth+1) . '</addition>');
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		return $this->_renderNode($this->_indent($this->depth+1) . '<multiplication type="array">' . PHP_EOL . implode(PHP_EOL, array_map(function (DerivableNodeInterface $child) {
				$v = new XMLVisitor($this->depth + 2);
				return $v->visit($child);
			}, $node->getChildren())) . PHP_EOL . $this->_indent($this->depth+1) . '</multiplication>');
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{
		return $this->_renderNode($this->_indent($this->depth+1) . '<multiplication type="binary">' . PHP_EOL . implode(PHP_EOL, array_map(function (DerivableNodeInterface $child) {
				$v = new XMLVisitor($this->depth + 2);
				return $v->visit($child);
			}, [$node->getA(), $node->getB()])) . PHP_EOL . $this->_indent($this->depth+1) . '</multiplication>');
	}


	public function visitPowerNode(PowerNode $node)
	{
		$v = new XMLVisitor($this->depth + 3);
		return $this->_renderNode($this->_indent($this->depth+1) . '<power>' . PHP_EOL .
			$this->_indent($this->depth+2) . '<base>' . PHP_EOL .
			$v->visit($node->getBase()) . PHP_EOL .
			$this->_indent($this->depth+2) . '</base>' . PHP_EOL .
			$this->_indent($this->depth+2) . 	'<exponent>' . PHP_EOL .
			$v->visit($node->getExponent()) . PHP_EOL .
			$this->_indent($this->depth+2) . 	'</exponent>' . PHP_EOL .
			$this->_indent($this->depth+1) . 	'</power>');
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $this->_renderNode($this->_indent($this->depth+1) . '<constant value="' . $node->getValue() . '"/>');
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return $this->_renderNode($this->_indent($this->depth+1) . '<variable value="' . $node->getName() . '"/>');
	}

	private function _renderNode($string)
	{
		if ($this->depth == 0) {
			return '<?xml version="1.0"?>
<node xmlns="http://www.sysvyz.org"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sysvyz.org resources/tree-schema.xsd">' . PHP_EOL . $string . PHP_EOL . '</node>';
		}
		return $this->_indent($this->depth) . '<node>' . PHP_EOL . $string . PHP_EOL . $this->_indent($this->depth) . '</node>';
	}

	private function _indent($depth)
	{
		return str_repeat(' ', $depth);
	}

}