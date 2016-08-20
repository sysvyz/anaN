<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 18.08.16
 * Time: 21:02
 */
namespace AnaN\Tree\Interfaces;

use AnaN\Tree\Functions\AdditionNode;
use AnaN\Tree\Functions\ArrayMultiplicationNode;
use AnaN\Tree\Functions\BinaryMultiplicationNode;
use AnaN\Tree\Functions\PowerNode;

interface VisitorInterface
{

	public function visit(NodeInterface $node);

	public function visitAdditionNode(AdditionNode $node);

	public function visitArrayMultiplicationNode(ArrayMultiplicationNode $node);

	public function visitBinaryMultiplicationNode(BinaryMultiplicationNode $node);

	public function visitPowerNode(PowerNode $node);

	public function visitConstantNode(ConstantNodeInterface $node);

	public function visitVariableNode(VariableNodeInterface $node);
}