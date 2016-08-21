<?php namespace AnaNTest\Tree\Visitor;

use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Interfaces\VisitorInterface;
use AnaN\Tree\Visitor\AbstractVisitor;
use AnaN\Tree\Visitor\Bool\IsConstantTermVisitor;
use AnaN\Tree\Visitor\Bool\TypeVisitor;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;

class IsConstantTermVisitorTest extends \PHPUnit_Framework_TestCase
{


	/**
	 * @return SimplifyVisitor
	 */
	public function testVisitor()
	{
		$ctv = new IsConstantTermVisitor();
		$this->assertTrue($ctv->visit(Tree::add(3,5,Tree::mult(3,5,Tree::pow(3,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add('x',5,Tree::mult(3,5,Tree::pow(3,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add(3,'x',Tree::mult(3,5,Tree::pow(3,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add(3,5,Tree::mult('x',5,Tree::pow(3,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add(3,5,Tree::mult(3,'x',Tree::pow(3,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add(3,5,Tree::mult(3,5,Tree::pow(3,4)),'x')));
		$this->assertFalse($ctv->visit(Tree::pow(Tree::add(3,5,Tree::mult(3,5,'x',4)),4)));
		$this->assertFalse($ctv->visit(Tree::pow(Tree::add(3,5,'x',Tree::mult(3,5,4)),4)));
		$this->assertFalse($ctv->visit(Tree::add(3,5,Tree::mult(3,5,Tree::pow(3,'x')),4)));

	}

}