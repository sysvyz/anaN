<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:06
 */

namespace AnaN\Tree\Functions;


use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;
use AnaN\Tree\Interfaces\VisitorInterface;

class AdditionNode extends AbstractDerivableNode
{

	protected static $precedence = 4;

	/**
	 * @var \AnaN\Tree\Interfaces\DerivableNodeInterface[]|array
	 */
	private $children = [];

	/**
	 * AdditionNode constructor.
	 * @param DerivableNodeInterface[] ...$children
	 */
	public function __construct(DerivableNodeInterface ...$children)
	{
		foreach ($children as $key => $c) {
			if ($c instanceof AdditionNode) {
				foreach ($c->children as $cKey => $child) {
					$this->children[] = $child;
				}
			} else {
				$this->children[] = $c;
			}
		}

	}

	public function accept(VisitorInterface $visitor)
	{
		return $visitor->visitAdditionNode($this);
	}

	/**
	 * @return \AnaN\Tree\Interfaces\DerivableNodeInterface[]
	 */
	public function getChildren()
	{
		return $this->children;
	}


}