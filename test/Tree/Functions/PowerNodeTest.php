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

class PowerNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testPowerNodeWithOnlyConstants()
    {
        $node = new PowerNode(new ConstantNode(4),new ConstantNode(3));
        $d = $node->derive('x');

        $this->assertEquals(0, $d->eval(['x' => 3]));
        $this->assertEquals(64, $node->eval(['x' => 3]));
    }
    public function testPowerNodeWithVar()
    {
        $node = new PowerNode(new VariableNode('x'),new ConstantNode(3));
        $d = $node->derive('x');
        $this->assertEquals(27, $d->eval(['x' => 3]));
        $this->assertEquals(27, $node->eval(['x' => 3]));
    }



}
