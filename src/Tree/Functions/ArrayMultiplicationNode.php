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

class ArrayMultiplicationNode extends AbstractDerivableNode
{

	protected static $precedence = 5;

	/**
	 * @var \AnaN\Tree\Interfaces\DerivableNodeInterface[]
	 */
	private $children = [];

	/**
	 * BinaryMultiplicationNode constructor.
	 * @param \AnaN\Tree\Interfaces\DerivableNodeInterface[] $children
	 */
	public function __construct(DerivableNodeInterface ...$children)
	{
		foreach ($children as $key => $c) {
			if ($c instanceof ArrayMultiplicationNode) {
				foreach ($c->children as $key => $child) {
					$this->children[] = $child;
				}
			} else {
				$this->children[] = $c;
			}
		}
	}

	private function copy($c)
	{
		return $c;
	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitArrayMultiplicationNode($this);
	}

	/**
	 * @return \AnaN\Tree\Interfaces\DerivableNodeInterface[]
	 */
	public function getChildren()
	{
		return $this->children;
	}

}