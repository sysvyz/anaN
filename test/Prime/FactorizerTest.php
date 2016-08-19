<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 09.08.16
 * Time: 17:12
 */

namespace Prime;


use AnaN\Prime\Factorizer;

class FactorizerTest extends \PHPUnit_Framework_TestCase
{

    public function testgetPrimeFactors()
    {
        $f = new Factorizer();
        $this->assertEquals([2 => 2, 3 => 1, 13 => 1, 331 => 1], $f->getPrimeFactors(51636));
        $this->assertEquals([7 => 1, 13 => 1, 19 => 1], $f->getPrimeFactors(1729));
        $this->assertEquals([3 => 2, 17 => 1, 2971 => 1], $f->getPrimeFactors(454563));
        $this->assertEquals([2 => 1], $f->getPrimeFactors(2));
        $this->assertEquals([3 => 1], $f->getPrimeFactors(3));

    }

    public function testGetDivisors()
    {
        $f = new Factorizer();
        $this->assertEquals([1, 3, 9, 17, 51, 153, 2971, 8913, 26739, 50507, 151521, 454563],
            $f->getDivisors(454563));
        $this->assertEquals([1, 2, 4, 3, 6, 12, 9, 18, 36, 5, 10, 20, 15, 30, 60, 45, 90, 180],
            $f->getDivisors(2 * 2 * 3 * 3 * 5));
        $this->assertEquals([1, 2, 4, 3, 6, 12],
            $f->getDivisors(12));

    }

}
