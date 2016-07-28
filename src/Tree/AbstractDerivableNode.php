<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 23:41
 */

namespace AnaN\Tree;


use AnaN\Tree\Interfaces\DerivableNodeInterface;

abstract class AbstractDerivableNode implements DerivableNodeInterface
{

    public function isDerivable():bool
    {
        return true;
    }
}