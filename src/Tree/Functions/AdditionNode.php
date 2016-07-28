<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:06
 */

namespace AnaN\Tree\Functions;


use AnaN\Calculus\Derivable;
use AnaN\Tree\AbstractDerivableNode;
use AnaN\Tree\Interfaces\DerivableNodeInterface;

class AdditionNode extends AbstractDerivableNode
{
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
        $this->children = $children;
    }

    public function derive(string $variableName) : Derivable
    {
        return new AdditionNode(...array_map(function (DerivableNodeInterface $child) use ($variableName) {
            return $child->derive($variableName);
        }, $this->children));
    }

    public function eval(array $variables)
    {
        return array_sum(array_map(function (DerivableNodeInterface $child) use ($variables) {
            return $child->eval($variables);
        }, $this->children));
    }


}