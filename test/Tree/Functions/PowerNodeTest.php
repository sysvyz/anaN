<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 01:32
 */

namespace AnaNTest\Tree\Functions;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\EvaluationVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;

class PowerNodeTest extends \PHPUnit_Framework_TestCase
{
	public function testPowerNodeWithOnlyConstants()
	{
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 3]);
		$node = new PowerNode(new ConstantNode(4), new ConstantNode(3));
		$d = $deriver->visit($node);

		$this->assertEquals(0, $eval->visit($d));
		$this->assertEquals(64, $eval->visit($node));
	}

	public function testPowerNodeWithVar()
	{
		$deriver = new DerivationVisitor('x');
		$eval2 = new EvaluationVisitor(['x' => 2]);
		$eval3 = new EvaluationVisitor(['x' => 3]);
		$node = new PowerNode(new VariableNode('x'), new ConstantNode(3));
		$d = $deriver->visit($node);
		$this->assertEquals(12, $eval2->visit($d));
		$this->assertEquals(8, $eval2->visit($node));
		$this->assertEquals(27, $eval3->visit($d));
		$this->assertEquals(27, $eval3->visit($node));
	}


}
