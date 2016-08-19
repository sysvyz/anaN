<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:39
 */

namespace AnaN\Tree\Functions;


use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\ConstantNode;
use AnaN\Tree\Factory\Tree;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

class PowerNode extends AbstractDerivableNode
{
	protected static $precedence = 6;

	/**
	 * @var DerivableNodeInterface
	 */
	private $base;

	/**
	 * @var DerivableNodeInterface
	 */
	private $exponent;

	/**
	 * BinaryMultiplicationNode constructor.
	 * @param $a
	 * @param $b
	 */
	public function __construct(DerivableNodeInterface $a, DerivableNodeInterface $b)
	{
		$this->base = $a;
		$this->exponent = $b;
	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitPowerNode($this);
	}

	/**
	 * @return DerivableNodeInterface
	 */
	public function getBase(): DerivableNodeInterface
	{
		return $this->base;
	}

	/**
	 * @return DerivableNodeInterface
	 */
	public function getExponent(): DerivableNodeInterface
	{
		return $this->exponent;
	}


}