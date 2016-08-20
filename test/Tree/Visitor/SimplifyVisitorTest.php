<?php namespace AnaNTest\Tree\Visitor;

use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Interfaces\VisitorInterface;
use AnaN\Tree\Visitor\AbstractVisitor;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;
use AnaN\Tree\Visitor\RenderStringVisitor;

class SimplifyVisitorTest extends \PHPUnit_Framework_TestCase
{


	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor()
	{
		$visitor = SimplifyVisitor::init();


		$this->assertInstanceOf(VisitorInterface::class, $visitor);
		$this->assertInstanceOf(AbstractVisitor::class, $visitor);
		$this->assertInstanceOf(SimplifyVisitor::class, $visitor);
		return $visitor;


	}


	/**
	 */
	public function testSimplify1()
	{

		$renderer = RenderStringVisitor::init();
		$simplifier = SimplifyVisitor::init();
		$node = Tree::pow(2, Tree::add(2, 4));
		$x = $renderer->visit($simplifier->visit($node));
		$this->assertEquals('2 ^ 6', $x);

	}

	/**
	 */
	public function testSimplify2()
	{

		$renderer = RenderStringVisitor::init();
		$simplifier = SimplifyVisitor::init();
		$node = Tree::mult(3, Tree::pow('x', 2), Tree::mult(2, 'x'), 3);
		$x = $renderer->visit($simplifier->visit($node));

		$this->assertEquals('18 * x ^ 2 * x', $x);

	}

}