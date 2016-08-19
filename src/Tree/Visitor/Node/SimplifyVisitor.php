<?php namespace AnaN\Tree\Visitor\Node;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\Bool\IsOneVisitor;
use AnaN\Tree\Visitor\Bool\IsZeroVisitor;
use AnaN\Tree\Visitor\Bool\TypeVisitor;
use AnaN\Tree\Visitor\EvaluationVisitor;

class SimplifyVisitor extends AbstractNodeVisitor
{

	/**
	 * @var TypeVisitor
	 */
	private $isConstantVisitor;
	/**
	 * @var IsZeroVisitor
	 */
	private $isZeroVisitor;
	/**
	 * @var IsOneVisitor
	 */
	private $isOneVisitor;

	private $evaluationVisitor;

	public static function init(){

		static $instance ;
		if(!$instance){
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * SimplifyVisitor constructor.
	 */
	private function __construct()
	{
		$this->isConstantVisitor = new TypeVisitor(ConstantNode::class);
		$this->evaluationVisitor = EvaluationVisitor::default();
		$this->isZeroVisitor = IsZeroVisitor::init();
		$this->isOneVisitor = IsOneVisitor::init();
	}


	public function visitAdditionNode(AdditionNode $node)
	{
		$nodes = [];
		$constant = 0;
		foreach ($node->getChildren() as $child) {
			$child = $this->visit($child);
			if ($this->isConstantVisitor->visit($child)) {
				$constant += $this->evaluationVisitor->visit($child);
			} else if (!$this->isZeroVisitor->visit($child)) {
				$nodes [] = $this->visit($child);
			}
		}
		if ($constant != 0) {
			$nodes[] = new ConstantNode($constant);
		}
		if (count($nodes) == 0) {
			return Tree::init(0);
		}
		if (count($nodes) == 1) {
			return $nodes[0];
		}
		return new AdditionNode(... $nodes);
	}

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node)
	{
		$nodes = [];
		$constant = 1;

		foreach ($node->getChildren() as $key => $c) {
			$child = $this->visit($c);

			if ($this->isZeroVisitor->visit($child)) {
				return Tree::init(0);
			} else if ($this->isConstantVisitor->visit($child)) {
				$constant *= $this->evaluationVisitor->visit($child);
			} else {

				$nodes[] = $child;
			}
		}
		if ($constant != 1) {
			array_unshift($nodes, new ConstantNode($constant));
		}
		if (count($nodes) == 1) {
			return $nodes[0];
		}

		return new ArrayMultiplicationNode(... $nodes);
	}

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node)
	{
		if ($this->isZeroVisitor->visit($node)) {
			return new ConstantNode(0);
		}

		$a = $this->visit($node->getA());
		$b = $this->visit($node->getB());


		if ($this->isOneVisitor->visit($a)) {
			return $b;
		}
		if ($this->isOneVisitor->visit($b)) {
			return $a;
		}


		if ($this->isConstantVisitor->visit($a)) {
			if ($this->isConstantVisitor->visit($b)) {
				return new ConstantNode($this->evaluationVisitor->visit($a) * $this->evaluationVisitor->visit($b));
			}
		}

		return new BinaryMultiplicationNode($a, $b);
	}

	public function visitPowerNode(PowerNode $node)
	{
		$a = $this->visit($node->getBase());
		$b = $this->visit($node->getExponent());

		//TODO REMOVE
		if ($this->isZeroVisitor->visit($a)) {
			return Tree::init(0);
		}
		if ($this->isZeroVisitor->visit($b)) {
			return Tree::init(1);
		}
		if ($this->isOneVisitor->visit($b)) {
			return $a;
		}
		return new PowerNode($a,$b);
	}

	public function visitConstantNode(ConstantNodeInterface $node)
	{
		return $node;
	}

	public function visitVariableNode(VariableNodeInterface $node)
	{
		return $node;
	}
}