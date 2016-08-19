<?php namespace AnaNTest\Tree\Visitor;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Interfaces\VisitorInterface;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\AbstractVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;
use AnaN\Tree\Visitor\RenderStringVisitor;

class RenderStringVisitorTest extends \PHPUnit_Framework_TestCase
{


	/**
	 * @return RenderStringVisitor
	 */
	public function testVisitor()
	{
		$renderer = RenderStringVisitor::init();

		$this->assertInstanceOf(VisitorInterface::class, $renderer);
		$this->assertInstanceOf(AbstractVisitor::class, $renderer);
		$this->assertInstanceOf(RenderStringVisitor::class, $renderer);
		return $renderer;
	}


	public function testRenderConstant()
	{

		$renderer = RenderStringVisitor::init();
		$node = new ConstantNode(2);
		$x = $renderer->visit($node);

		$this->assertEquals('2', $x);

	}

	public function testRenderVariable()
	{

		$renderer = RenderStringVisitor::init();
		$node = new VariableNode('x');
		$x = $renderer->visit($node);

		$this->assertEquals('x', $x);

	}

	public function testRenderAddition()
	{

		$renderer = RenderStringVisitor::init();
		$node = $this->_buildAdditionNode();
		$x = $renderer->visit($node);

		$this->assertEquals('x + 3 + 2 + x', $x);

	}

	public function testRenderArrayMultiplicationNode()
	{

		$renderer = RenderStringVisitor::init();
		$node = $this->_buildArrayMultiplicationNode();
		$x = $renderer->visit($node);

		$this->assertEquals('x * 3 * (2 + x)', $x);

	}


	public function testTreeRender()
	{

		$deriver = new DerivationVisitor('x');
		$renderer = RenderStringVisitor::init();
		$simplfier = SimplifyVisitor::init();
		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		$this->assertEquals("3 * x ^ 2 + 2 * x + 3", $renderer->visit($f));


		$this->assertEquals("6 * x + 2", $renderer->visit($simplfier->visit($deriver->visit($f))));
		$this->assertEquals("6", $renderer->visit($simplfier->visit($deriver->visit($deriver->visit($f)))));
	}

	public function testTreeRender2()
	{

		$deriver = new DerivationVisitor('x');
		$simplfier = SimplifyVisitor::init();
		$renderer = RenderStringVisitor::init();
		$f = Tree::add(Tree::mult(3, 'x'), Tree::mult(2, 'x'), 3)->pow(2);

		$this->assertEquals("(3 * x + 2 * x + 3) ^ 2", $renderer->visit($f));


		$this->assertEquals('10 * (3 * x + 2 * x + 3)', $renderer->visit($simplfier->visit($deriver->visit($f))));


		$this->assertEquals(50, $renderer->visit($simplfier->visit($deriver->visit($deriver->visit($f)))));
	}

	private function _buildAdditionNode()
	{
		return new AdditionNode(
			new VariableNode('x'),
			new ConstantNode(3),
			new AdditionNode(
				new ConstantNode(2),
				new VariableNode('x')
			)
		);
	}

	private function _buildArrayMultiplicationNode()
	{
		return new ArrayMultiplicationNode(
			new VariableNode('x'),
			new ConstantNode(3),
			new AdditionNode(
				new ConstantNode(2),
				new VariableNode('x')
			)
		);
	}
}