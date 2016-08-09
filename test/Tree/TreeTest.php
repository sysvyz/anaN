<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 09.08.16
 * Time: 00:34
 */

namespace Tree;


use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;
use AnaN\Tree\VariableNode;

class TreeTest extends \PHPUnit_Framework_TestCase
{

	public function testTree()
	{
		$f = (new AdditionNode(
			new BinaryMultiplicationNode(
				new ConstantNode(3),
				new PowerNode(
					new VariableNode('x'),
					new ConstantNode(2)
				)
			),
			new BinaryMultiplicationNode(
				new ConstantNode(2),
				new VariableNode('x')
			)
		))->add(3);
		$this->assertEquals(19, $f->eval(['x' => 2]) );
		$this->assertEquals(14, $f->derive('x')->eval(['x' => 2]) );
	}

	public function testTree2()
	{

		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		$this->assertEquals(19, $f->eval(['x' => 2]) );
		$this->assertEquals(14, $f->derive('x')->eval(['x' => 2]) );
	}
	public function testTree3()
	{
		$f = Tree::mult(3, Tree::pow('x', 2))->add(Tree::mult(2, 'x'))->add(3);
		$this->assertEquals(19, $f->eval(['x' => 2]) );
		$this->assertEquals(14, $f->derive('x')->eval(['x' => 2]) );
	}
	public function testTree4()
	{
		Tree::init(3)->mult(Tree::init('x')->pow(2))->add(Tree::init(2)->mult('x')->add(3));

		$f = Tree::mult(3, Tree::pow('x', 2))->add(Tree::mult(2, 'x'))->add(3);
		$this->assertEquals(19, $f->eval(['x' => 2]) );
		$this->assertEquals(14, $f->derive('x')->eval(['x' => 2]) );
	}



	public function testTreeRender()
	{

		$f = Tree::add(Tree::mult(3, Tree::pow('x', 2)), Tree::mult(2, 'x'), 3);
		print_r($f->render().PHP_EOL);
	}

	public function testTreeRender2()
	{

		$f = Tree::add(Tree::mult(3, 'x'), Tree::mult(2, 'x'), 3)->pow(2);
		print_r($f->render().PHP_EOL);
	}
}


