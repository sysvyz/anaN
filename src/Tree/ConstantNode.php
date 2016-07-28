<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 23:58
 */

namespace AnaN\Tree;


use AnaN\Calculus\Derivable;
class ConstantNode implements ConstantNodeInterface
{
    private $val;

    /**
     * ConstantNode constructor.
     * @param $val
     */
    public function __construct($val)
    {
        $this->val = $val;
    }

    public function derive(string $variableName):Derivable
    {
        return new self(0);
    }

    public function eval(array $variables)
    {
        return $this->val;
    }

    public function isDerivable():bool
    {
        return true;
    }

}