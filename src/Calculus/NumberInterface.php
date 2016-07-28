<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 22:42
 */

namespace AnaN\Calculus;


interface NumberInterface
{


    public function add(NumberInterface $other);
    public function sub(NumberInterface $other);
    public function mul(NumberInterface $other);
    public function div(NumberInterface $other);

}