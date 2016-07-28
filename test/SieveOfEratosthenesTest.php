<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 21:32
 */

namespace AnaNTest;


use AnaN\Prime\SieveOfEratosthenes;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class SieveOfEratosthenesTest extends \PHPUnit_Framework_TestCase
{

    public function testSieve()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(10);
        $this->assertEquals(7,end($primes));

    }
    public function testSieve2()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(40);
        $this->assertEquals(37,end($primes));

    }
    public function testSieve3()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(19);
        $this->assertEquals(19,end($primes));

    }
    public function testSieve4()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(85);
        $this->assertEquals(83,end($primes));

    }
    public function testSieve5()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(2);
        $this->assertEquals(2,end($primes));

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSieve6()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(1);
        $this->assertEquals(2,end($primes));

    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testSieve7()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(-1);
        $this->assertEquals(2,end($primes));

    }

    public function testSieve8()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes('33');
        $this->assertEquals(31,end($primes));

    }

    public function testSieve9()
    {
        $sieve = new SieveOfEratosthenes();
        $primes = $sieve->getPrimes(3);
        $this->assertEquals(3,end($primes));

    }


}
