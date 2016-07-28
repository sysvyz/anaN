<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 21:04
 */

namespace AnaN\Prime;


use Doctrine\Instantiator\Exception\InvalidArgumentException;

class SieveOfEratosthenes
{

    public function getPrimes(int $limit)
    {
        if(!($limit>1)){
            throw new InvalidArgumentException();
        }

        $arr = array_fill(2, $limit - 1, true);
        for ($i = 2; $i < $limit+1; $i++) {
            if ($arr[$i]) {
                $prim = $i;
                $sum = $prim << 1;
                while ($sum <= $limit) {
                    $arr[$sum] = 0;
                    $sum += $prim;
                }
            }
        }
        return array_keys(array_filter($arr));
    }
}