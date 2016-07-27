<?php namespace AnaN;

use AnaN\PolynomialRegression\PolynomialRegression\PolynomialRegression;


abstract class Statistic
{
    public static function avg($array)
    {
        return self::average($array);
    }

    public static function count($array)
    {
        return count($array);
    }

    public static function num($array)
    {
        return count($array);
    }

    public static function sum($array)
    {

        return array_sum($array);
    }

    public static function size($array)
    {
        return count($array);
    }

    /**
     * @param $array
     * @return int | null
     */
    public static function max($array)
    {
        $max = null;
        foreach ($array as $value) {

            $max = ($max == null || $max < $value) ? $value : $max;

        }
        return $max;
    }

    /**
     * @param $array
     * @return int | null
     */
    public static function min($array)
    {
        $min = null;
        foreach ($array as $value) {

            $min = ($min == null || $min > $value) ? $value : $min;

        }
        return $min;
    }

    public static function average($array)
    {
        return self::count($array) ? self::sum($array) / self::count($array) : null;
    }

    public static function med($array)
    {
        return self::quartile_50($array);
    }

    public static function stats($array)
    {
        sort($array);
        $min = self::count($array) ? $array[0] : null;
        $max = self::count($array) ? end($array) : null;


        return [
            'num' => self::count($array),
            'min' => $min,
            'max' => $max,
            'avg' => self::average($array),
            'stdDeviation' => self::standardDeviation($array),
            'median' => self::_quartile($array, 0.5),
            'quartiles' => [
                self::_quartile($array, 0.25),
                self::_quartile($array, 0.5),
                self::_quartile($array, 0.75)
            ],
        ];
    }

    public static function median($array)
    {
        return self::quartile_50($array);
    }

    public static function quartile_25($array)
    {
        return self::quartile($array, 0.25);
    }

    public static function quartile_50($array)
    {
        return self::quartile($array, 0.5);
    }

    public static function quartile_75($array)
    {
        return self::quartile($array, 0.75);
    }

    public static function quartile($array, $quartile)
    {
        sort($array);
        return self::_quartile($array, $quartile);
    }

    public static function _quartile($array, $quartile)
    {
        $count = self::count($array);

        if ($count == 0) {
            return null;
        }
        $pos = ($count - 1) * $quartile;

        $base = floor($pos);
        $rest = $pos - $base;

        if (isset($array[$base + 1])) {
            return $array[$base] + $rest * ($array[$base + 1] - $array[$base]);
        } else {
            return $array[$base];
        }
    }

    /**
     * @param $array Point2DInterface[]
     * @return array
     */
    public static function linearRegression($array)
    {

        $x = array_map(function (Point2DInterface $point) {
            return $point->getX1();
        }, $array);
        $y = array_map(function (Point2DInterface $point) {
            return $point->getX2();
        }, $array);

        // Precision digits in BC math.
        bcscale(10);

        // Start a regression class of order 2--linear regression.
        $linReg = new PolynomialRegression(2);

        // Add all the data to the regression analysis.
        foreach ($array as $dataPoint)
            $linReg->addData($dataPoint->getX1(), $dataPoint->getX2());

        // Get coefficients for the polynomial.
        $coefficients = $linReg->getCoefficients();
        return ['k' => $coefficients[1], 'd' => $coefficients[0]];
    }

    /**
     * @param $array Point2DInterface[]
     */
    public static function quadraticRegression($array)
    {

    }

    /**
     * @param array $a
     * @param bool $sample [optional] Defaults to false
     * @return float|bool The standard deviation or false on error.
     */
    public static function standardDeviation(array $a, $sample = false)
    {
        return stats_standard_deviation($a, $sample);
    }
}

if (!function_exists('stats_standard_deviation')) {
    /**
     * from comments
     * http://php.net/manual/de/function.stats-standard-deviation.php
     *
     * This user-land implementation follows the implementation quite strictly;
     * it does not attempt to improve the code or algorithm in any way. It will
     * raise a warning if you have fewer than 2 values in your array, just like
     * the extension does (although as an E_USER_WARNING, not E_WARNING).
     *
     * @param array $a
     * @param bool $sample [optional] Defaults to false
     * @return float|bool The standard deviation or false on error.
     */
    function stats_standard_deviation(array $a, $sample = false)
    {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double)$val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }
}
