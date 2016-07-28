<?php namespace AnaN\Tree\Interfaces;


use AnaN\Calculus\Derivable;

interface DerivableNodeInterface extends FunctionNodeInterface, Derivable
{

    public function derive(string $variableName) : Derivable;


}