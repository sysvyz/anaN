<?php namespace AnaNTest\Tree\Visitor;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Interfaces\VisitorInterface;
use AnaN\Tree\Visitor\AbstractVisitor;
use AnaN\Tree\Visitor\Bool\TypeVisitor;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;

class TypeVisitorTest extends \PHPUnit_Framework_TestCase
{


	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor()
	{
		$visitor = new TypeVisitor(AdditionNode::class);

		$this->assertInstanceOf(VisitorInterface::class, $visitor);
		$this->assertInstanceOf(AbstractVisitor::class, $visitor);
		$this->assertInstanceOf(TypeVisitor::class, $visitor);

		$this->assertTrue($visitor->visit(Tree::add(2,3)));
		$this->assertFalse($visitor->visit(new ConstantNode(2)));

	}

	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor2()
	{
		$visitor = new TypeVisitor(ConstantNode::class);

		$this->assertFalse($visitor->visit(Tree::add(2,3)));
		$this->assertFalse($visitor->visit(Tree::pow(2,3)));
		$this->assertFalse($visitor->visit(Tree::mult(2,3)));
		$this->assertTrue($visitor->visit(Tree::init(3)));
		$this->assertFalse($visitor->visit(Tree::init('x')));

	}
	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor3()
	{
		$visitor = new TypeVisitor(ArrayMultiplicationNode::class);

		$this->assertFalse($visitor->visit(Tree::add(2,3)));
		$this->assertFalse($visitor->visit(Tree::pow(2,3)));
		$this->assertTrue($visitor->visit(Tree::mult(2,3)));
		$this->assertFalse($visitor->visit(Tree::init(3)));
		$this->assertFalse($visitor->visit(Tree::init('x')));

	}
	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor4()
	{
		$visitor = new TypeVisitor(VariableNode::class);

		$this->assertFalse($visitor->visit(Tree::add(2,3)));
		$this->assertFalse($visitor->visit(Tree::pow(2,3)));
		$this->assertFalse($visitor->visit(Tree::mult(2,3)));
		$this->assertFalse($visitor->visit(Tree::init(3)));
		$this->assertTrue($visitor->visit(Tree::init('x')));

	}

}