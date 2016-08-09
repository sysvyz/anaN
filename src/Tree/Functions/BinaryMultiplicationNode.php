<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:39
 */

namespace AnaN\Tree\Functions;

use AnaN\Calculus\Derivable;
use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;

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


	public function eval(array $variables)
	{
		return array_product(array_map(function (DerivableNodeInterface $child) use ($variables) {
			return $child->eval($variables);
		}, [$this->a, $this->b]));
	}


	public function derive(string $variableName) : Derivable
	{
		$x = new  BinaryMultiplicationNode($this->a->derive($variableName), $this->b);
		$y = new  BinaryMultiplicationNode($this->a, $this->b->derive($variableName));
		return new  AdditionNode($x, $y);
	}


	/**
	 * @return string
	 */
	public function render($braced = false)
	{

		$bA = $this->a->getPrecedence()<$this->getPrecedence();

		$bB = ($this->b->getPrecedence()<$this->getPrecedence())?('('):('');

		return ($braced?'(':'').$this->a->render($bA) . ' * ' .$this->b->render($bB).($braced?')':'');
	}

}