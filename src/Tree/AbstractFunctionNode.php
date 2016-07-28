<?php namespace AnaN\Tree;


use AnaN\Tree\Interfaces\FunctionNodeInterface;

abstract class AbstractFunctionNode implements FunctionNodeInterface
{

    public function isDerivable():bool
    {
        return false;
    }
}