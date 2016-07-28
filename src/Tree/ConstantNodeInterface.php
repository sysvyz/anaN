<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:01
 */
namespace AnaN\Tree;

use AnaN\Tree\Interfaces\DerivableNodeInterface;

interface ConstantNodeInterface extends DerivableNodeInterface
{

    public function isDerivable() : bool;
}