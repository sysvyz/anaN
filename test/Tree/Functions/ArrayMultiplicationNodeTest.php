<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 09.08.16
 * Time: 23:31
 */

namespace AnaNTest\Tree\Functions;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\Node\SimplifyVisitor;
use AnaN\Tree\Visitor\RenderStringVisitor;

class ArrayMultiplicationNodeTest extends \PHPUnit_Framework_TestCase
{
	public function testArrMul()
	{
		$renderer =  RenderStringVisitor::init();
		$simplfier = SimplifyVisitor::init();
		$am = new ArrayMultiplicationNode(new ConstantNode(3),new ConstantNode(4),new ConstantNode(5));
		$this->assertEquals('3 * 4 * 5',$renderer->visit($am));
		$this->assertEquals('60',$renderer->visit($simplfier->visit($am)));
	}
	public function testArrMul2()
	{
		$renderer =  RenderStringVisitor::init();
		$simplfier = SimplifyVisitor::init();
		$am = new ArrayMultiplicationNode(new ConstantNode(3),new VariableNode('x'),new ConstantNode(5));
		$this->assertEquals('3 * x * 5',$renderer->visit($am));
		$this->assertEquals('15 * x',$renderer->visit($simplfier->visit($am)));
	}
}
