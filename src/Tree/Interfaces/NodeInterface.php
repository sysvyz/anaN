<?php namespace AnaN\Tree\Interfaces;



use AnaN\Tree\Interfaces\VisitorInterface;

interface NodeInterface
{

	public function accept(VisitorInterface $visitor);
}