<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:11
 */

namespace AnaNTest\Tree\Functions;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\EvaluationVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;

class AdditionNodeTest extends \PHPUnit_Framework_TestCase
{
	public function testAddNodeWithOnlyConstants()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 3]);
		$node = new AdditionNode(new ConstantNode(4), new ConstantNode(2), new ConstantNode(1));
		$d = $deriver->visit($node);
		$this->assertEquals(7, $eval->visit($node));
		$this->assertEquals(0, $eval->visit($d));
	}

	public function testAddNodeWithVariable()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 3]);
		$node = new AdditionNode(new ConstantNode(4), new ConstantNode(2), new VariableNode('x'));
		$d = $deriver->visit($node);
		$dd = $deriver->visit($d);
		$this->assertEquals(9, $eval->visit($node));
		$this->assertEquals(1, $eval->visit($d));
		$this->assertEquals(0, $eval->visit($dd));
	}
}
