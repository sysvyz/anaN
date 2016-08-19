<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:39
 */

namespace AnaN\Tree\Functions;

use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

class BinaryMultiplicationNode extends AbstractDerivableNode
{

	protected static $precedence = 5;
	/**
	 * @var DerivableNodeInterface
	 */
	private $a;
	/**
	 * @var DerivableNodeInterface
	 */
	private $b;

	/**
	 * BinaryMultiplicationNode constructor.
	 * @param $a
	 * @param $b
	 */
	public function __construct(DerivableNodeInterface $a, DerivableNodeInterface $b)
	{
		$this->a = $a;
		$this->b = $b;
	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitBinaryMultiplicationNode($this);
	}

	/**
	 * @return DerivableNodeInterface
	 */
	public function getA(): DerivableNodeInterface
	{
		return $this->a;
	}

	/**
	 * @return DerivableNodeInterface
	 */
	public function getB(): DerivableNodeInterface
	{
		return $this->b;
	}

}