<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:11
 */

namespace Tree\Functions;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\VariableNode;

class AdditionNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testAddNodeWithOnlyConstants()
    {
        $node = new AdditionNode(new ConstantNode(4), new ConstantNode(2), new ConstantNode(1));
        $d = $node->derive('x');
        $this->assertEquals(0, $d->eval(['x' => 3]));
        $this->assertEquals(7, $node->eval(['x' => 3]));
    }

    public function testAddNodeWithVariable()
    {
        $node = new AdditionNode(new ConstantNode(4), new ConstantNode(2), new VariableNode('x'));
        $d = $node->derive('x');
        $dd = $d->derive('x');
        $this->assertEquals(9, $node->eval(['x' => 3]));
        $this->assertEquals(1, $d->eval(['x' => 3]));
        $this->assertEquals(0, $dd->eval(['x' => 3]));
    }
}
