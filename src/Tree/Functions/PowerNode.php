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
use AnaN\Tree\ConstantNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;

class PowerNode extends AbstractDerivableNode
{
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
        return   pow($this->a->eval($variables) , $this->b->eval($variables));
    }


    public function derive(string $variableName) : Derivable
    {
        $exp = new AdditionNode($this->b,new ConstantNode(-1));
        $pow = new PowerNode($this->a,$exp);
        return new BinaryMultiplicationNode(new BinaryMultiplicationNode($this->b,$pow),$this->a->derive($variableName));
    }
}