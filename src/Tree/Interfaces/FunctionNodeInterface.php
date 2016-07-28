<?php namespace AnaN\Tree\Interfaces;


use AnaN\Calculus\FunctionInterface;

interface FunctionNodeInterface extends NodeInterface, FunctionInterface
{
    public function eval(array $variables);

    public function isDerivable():bool;
}