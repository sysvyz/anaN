<?php namespace AnaNTest\Tree;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\EvaluationVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;
use AnaN\Tree\Visitor\RenderStringVisitor;

class TreeTest extends \PHPUnit_Framework_TestCase
{

	public function testTree()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 2]);
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
		$this->assertEquals(19, $eval->visit($f));
		$this->assertEquals(14, $eval->visit($deriver->visit($f)));
	}

	public function testTree2()
	{

		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 2]);
		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		$this->assertEquals(19, $eval->visit($f));
		$this->assertEquals(14, $eval->visit($deriver->visit($f)));
	}

	public function testTree3()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 2]);
		$f = Tree::mult(3, Tree::pow('x', 2))->add(Tree::mult(2, 'x'))->add(3);
		$this->assertEquals(19, $eval->visit($f));
		$this->assertEquals(14, $eval->visit($deriver->visit($f)));
	}

	public function testTree4()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 2]);
		Tree::init(3)->mult(Tree::init('x')->pow(2))->add(Tree::init(2)->mult('x')->add(3));

		$f = Tree::mult(3, Tree::pow('x', 2))->add(Tree::mult(2, 'x'))->add(3);
		$this->assertEquals(19, $eval->visit($f));
		$this->assertEquals(14, $eval->visit($deriver->visit($f)));
	}


	public function testTreeRender()
	{

		$renderer =  RenderStringVisitor::init();
		$simplfier = SimplifyVisitor::init();
		$deriver = new DerivationVisitor('x');
		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		$this->assertEquals("3 * x ^ 2 + 2 * x + 3", $renderer->visit($f));


		$this->assertEquals("6 * x + 2", $renderer->visit($simplfier->visit($deriver->visit($f))));
		$this->assertEquals("6", $renderer->visit($simplfier->visit($deriver->visit($deriver->visit($f)))));
	}

	public function testTreeRender2()
	{

		$deriver = new DerivationVisitor('x');
		$renderer =  RenderStringVisitor::init();
		$simplfier = SimplifyVisitor::init();
		$f = Tree::add(Tree::mult(3, 'x'), Tree::mult(2, 'x'), 3)->pow(2);

		$this->assertEquals("(3 * x + 2 * x + 3) ^ 2", $renderer->visit($f));
		$this->assertEquals('10 * (3 * x + 2 * x + 3)', $renderer->visit($simplfier->visit($deriver->visit($f))));
		$this->assertEquals(50, $renderer->visit($simplfier->visit($deriver->visit($deriver->visit($f)))));
	}

	public function testGetVariables()
	{

		$f = Tree::add(Tree::mult(3, 'x'), Tree::mult(2, 'y'), Tree::mult(Tree::pow('z', 2), 'y'), 3);

	}
}


