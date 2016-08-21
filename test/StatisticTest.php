<?php namespace AnaNTest;
use AnaN\Point2DInterface;
use AnaN\Statistic;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.07.16
 * Time: 15:06
 */
class StatisticTest extends \PHPUnit_Framework_TestCase
{


    public function testMax()
    {
        $data = [1, 54, 34252, -234, 34, 2, 35534, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(35534, Statistic::max($data));
    }

    public function testMin()
    {
        $data = [1, 54, 34252, -234, 34, 2, 35534, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(-235, Statistic::min($data));
    }


    public function testAverage()
    {
        $data = [1, 54, 34252, -234, 34, 2, 35534, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(5700.89473684, Statistic::average($data), '', 0.000001);
    }


    public function testAverage2()
    {
        $data = [1, 2, 3, 4, 5, 6, 7];
        $this->assertEquals(4, Statistic::average($data), '', 0.000001);
    }


    public function testMedian()
    {
        $data = [1, 2, 3, 4, 5, 6, 7];
        $this->assertEquals(4, Statistic::median($data));
    }


    public function testMedian2()
    {
        $data = [6, 2, 7, 3, 1, 5, 4,];
        $this->assertEquals(4, Statistic::median($data));
    }

    public function testMedian3()
    {
        $data = [1, 54, 34252, -234, 34, 2, 35534, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(56, Statistic::median($data));
    }

    public function testMedian4()
    {
        $data = [1, 54, 34252, -234, 34, 2, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(55, Statistic::median($data));
    }

    public function testStats()
    {
        $data = [6, 2, 7, 3, 1, 5, 4,];
        $this->assertEquals(
            ['num' => 7,
                'min' => 1,
                'max' => 7,
                'avg' => 4,
                'median' => 4.0,
                'stdDeviation' => 2.0,
                'quartiles' =>
                    [
                        2.5,
                        4,
                        5.5,
                    ]
            ],
            Statistic::stats($data), '', 0.00001);
    }

    public function testStats2()
    {
        $data = [1, 54, 34252, -234, 34, 2, 65, -34, 534, 34, 34253, -235, 243, 56, -23, 3223, 324, 234];
        $this->assertEquals(
            [
                'num' => 18,
                'min' => -235,
                'max' => 34253,
                'avg' => 4043.5,
                'stdDeviation' => 10706.13888,
                'median' => 55.0,
                'quartiles' =>
                    [
                        1.25,
                        55.0,
                        303.75,
                    ]
            ],
            Statistic::stats($data), '', 0.00001);
    }

    public function testLinReg()
    {
        $data = [
            new RegressionMock(0, 0),
            new RegressionMock(3, 1),
            new RegressionMock(4, 3),
            new RegressionMock(7, 2),
            new RegressionMock(8, 5),
            new RegressionMock(10, 5),
            new RegressionMock(12, 6),
            new RegressionMock(12, 8),
            new RegressionMock(14, 10),
            new RegressionMock(16, 9),
        ];
        $this->assertEquals([
            'k' => 0.627516778,
            'd' => -0.49664429530
        ], Statistic::linearRegression($data), '', 0.000001);
    }

}

/**
 * Class RegressionMock
 */
class RegressionMock implements Point2DInterface
{

    private $x;
    private $y;

    /**
     * RegMock constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }


    public function getX1()
    {
        return $this->x;
    }

    public function getX2()
    {

        return $this->y;
    }
}