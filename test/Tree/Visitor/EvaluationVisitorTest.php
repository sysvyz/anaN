<?php namespace AnaNTest\Tree\Visitor;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\Interfaces\VisitorInterface;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\AbstractVisitor;
use AnaN\Tree\Visitor\EvaluationVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;

class EvaluationVisitorTest extends \PHPUnit_Framework_TestCase
{


	/**
	 * @return EvaluationVisitor
	 */
	public function testVisitor()
	{
		$visitor = new EvaluationVisitor([]);


		$this->assertInstanceOf(VisitorInterface::class, $visitor);
		$this->assertInstanceOf(AbstractVisitor::class, $visitor);
		$this->assertInstanceOf(EvaluationVisitor::class, $visitor);
		return $visitor;


	}


	public function testTree()
	{

		$deriver = new DerivationVisitor('x');
		$evaluator = new EvaluationVisitor(['x' => 2]);
		$f = (new AdditionNode(
			new BinaryMultiplicationNode(
				new ConstantNode(3),
				new PowerNode(
					new VariableNode('x'),
					new ConstantNode(2)
				)
			),
			new BinaryMultiplicationNode(
				new ConstantNode(2),
				new VariableNode('x')
			)
		))->add(3);
		$this->assertEquals(19,$evaluator->visit($f));
		$this->assertEquals(14, $evaluator->visit($deriver->visit($f)));
	}

	public function testTree2()
	{

		$deriver = new DerivationVisitor('x');
		$evaluator = new EvaluationVisitor(['x' => 2]);
		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		$this->assertEquals(19, $evaluator->visit($f));
		$this->assertEquals(14, $evaluator->visit($deriver->visit($f)));
	}

	public function testTree3()
	{

		$deriver = new DerivationVisitor('x');
		$evaluator = new EvaluationVisitor(['x' => 2]);
		$f = Tree::mult(3, Tree::pow('x', 2))->add(Tree::mult(2, 'x'))->add(3);
		$this->assertEquals(19, $evaluator->visit($f));
		$this->assertEquals(14, $evaluator->visit($deriver->visit($f)));

	}
}