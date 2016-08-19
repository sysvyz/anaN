<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 18.08.16
 * Time: 20:57
 */

namespace AnaN\Tree\Visitor;


use AnaN\Tree\Interfaces\NodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

abstract class AbstractVisitor implements VisitorInterface
{
	public function visit(NodeInterface $node)
	{
		return $node->accept($this);
	}

}