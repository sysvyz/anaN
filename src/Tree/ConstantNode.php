<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 23:58
 */

namespace AnaN\Tree;


use AnaN\Tree\Interfaces\ConstantNodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

class ConstantNode extends AbstractDerivableNode implements ConstantNodeInterface
{
	private $value;

	/**
	 * ConstantNode constructor.
	 * @param $val
	 */
	public function __construct($val)
	{
		$this->value = $val;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitConstantNode($this);
	}

}