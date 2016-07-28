<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 22:21
 */

namespace AnaN\Calculus;


interface Derivable extends FunctionInterface
{
    public function derive(string $variableName):Derivable;

}