<?php namespace AnaN\Tree;


use AnaN\Calculus\Derivable;
use AnaN\Tree\Interfaces\VariableNodeInterface;

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


	public function derive(string $variableName):Derivable
	{
		return new ConstantNode(1);
	}

	public function eval(array $variables)
	{
		return $variables[$this->name];
	}

	public function isDerivable():bool
	{
		return true;
	}

	/**
	 * @return string
	 */
	public function render($braced = false)
	{
		return $this->name;
	}
}