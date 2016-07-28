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

class BinaryMultiplicationNodeTest extends \PHPUnit_Framework_TestCase
{

    public function testAddNodeWithOnlyConstants()
    {
        $node = new BinaryMultiplicationNode(new ConstantNode(4),new ConstantNode(3));
        $d = $node->derive('x');
        $this->assertEquals(0, $d->eval(['x' => 3]));
        $this->assertEquals(12, $node->eval(['x' => 3]));
    }

    public function testAddNodeWithVariable()
    {
        $node = new BinaryMultiplicationNode(new ConstantNode(2), new VariableNode('x'));
        $d = $node->derive('x');
        $dd = $d->derive('x');
        $this->assertEquals(6, $node->eval(['x' => 3]));
        $this->assertEquals(2, $d->eval(['x' => 3]));
        $this->assertEquals(0, $dd->eval(['x' => 3]));
    }
}
