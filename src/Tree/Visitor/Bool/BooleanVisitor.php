<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 19.08.16
 * Time: 01:01
 */

namespace AnaN\Tree\Visitor\Bool;


use AnaN\Tree\Interfaces\NodeInterface;
use AnaN\Tree\Visitor\AbstractVisitor;

abstract class BooleanVisitor extends AbstractVisitor
{
	public function visit(NodeInterface $node):bool
	{
		return $node->accept($this);
	}
}