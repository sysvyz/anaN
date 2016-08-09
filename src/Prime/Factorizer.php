<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 09.08.16
 * Time: 17:06
 */

namespace AnaN\Prime;


class Factorizer
{


    public function getPrimeFactors($n)
    {
        $iterator = new PrimesInterator();
        $factors = [];

        foreach ($iterator as $primes) {
            if ($primes > floor(sqrt($n))) {
                if (isset($factors[$n])) {
                    $factors[$n] = $factors[$n] + 1;
                } else {
                    $factors[$n] = 1;
                }
                break;
            }


            if ($n % $primes == 0) {
                while ($n % $primes == 0) {
                    if (isset($factors[$primes])) {
                        $factors[$primes] = $factors[$primes] + 1;
                    } else {
                        $factors[$primes] = 1;
                    }
                    $n = $n / $primes;
                }

            }


        }
        return $factors;

    }

    public function getDivisors($n)
    {
        $factors = $this->getPrimeFactors($n);

        $primes = array_keys($factors);
        $max = array_values($factors);

        $counters = array_fill(0, count($primes), 0);

        $pointer = 0;
        $divisors = [];

        while (true) {

            $divisors[] = array_product(array_map(function ($count, $prime) {
                return $count ? pow($prime, $count) : 1;
            }, $counters, $primes));

            $counters[$pointer]++;
            while ($counters[$pointer] > $max[$pointer]) {
                $counters[$pointer] = 0;
                $pointer++;
                if ($pointer >= count($counters)) {
                    return $divisors;
                }
                $counters[$pointer]++;
            }
            $pointer = 0;


        }


    }


    private function rec($list)
    {
        if (empty($list)) {
            return [];
        }


        $result = [$list];

        for ($i = 0; $i < count($list); $i++) {
            $copy = $this->remove($list, $i);


            $this->rec($copy);
            $result = array_merge($result, $this->rec($copy));
//print_r($result);die;
        }
        return $result;

    }


    private function remove($list, $index)
    {
        unset($list[$index]);
        return array_values($list);
    }

}