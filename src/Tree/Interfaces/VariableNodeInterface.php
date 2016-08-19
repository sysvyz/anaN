<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 23:57
 */

namespace AnaN\Tree\Interfaces;


interface VariableNodeInterface extends DerivableNodeInterface
{

	/**
	 * @return mixed
	 */
	public function getName();
}