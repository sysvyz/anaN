<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 29.07.16
 * Time: 00:01
 */
namespace AnaN\Tree\Interfaces;

use AnaN\Tree\Interfaces\DerivableNodeInterface;

interface ConstantNodeInterface extends DerivableNodeInterface
{

	/**
	 * @return mixed
	 */
	public function getValue();
}