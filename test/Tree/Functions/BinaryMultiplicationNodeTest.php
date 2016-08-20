<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:51
 */

namespace AnaNTest\Tree\Functions;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\VariableNode;
use AnaN\Tree\Visitor\EvaluationVisitor;
use AnaN\Tree\Visitor\Node\DerivationVisitor;

class BinaryMultiplicationNodeTest extends \PHPUnit_Framework_TestCase
{

    public function testAddNodeWithOnlyConstants()
    {
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 3]);
        $node = new BinaryMultiplicationNode(new ConstantNode(4),new ConstantNode(3));
        $d = $deriver->visit($node);
        $this->assertEquals(0, $eval->visit($d));
        $this->assertEquals(12, $eval->visit($node));
    }

    public function testAddNodeWithVariable()
    {
		$deriver = new DerivationVisitor('x');
		$eval = new EvaluationVisitor(['x' => 3]);
        $node = new BinaryMultiplicationNode(new ConstantNode(2), new VariableNode('x'));
		$d = $deriver->visit($node);
		$dd = $deriver->visit($d);
        $this->assertEquals(6, $eval->visit($node));
        $this->assertEquals(2,$eval->visit($d));
        $this->assertEquals(0, $eval->visit($dd));
    }
}
