<?php namespace AnaN\Tree;


use AnaN\Tree\Interfaces\VariableNodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

class VariableNode extends AbstractDerivableNode implements VariableNodeInterface
{

	private $name;

	/**
	 * VariableNode constructor.
	 * @param $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitVariableNode($this);
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


}