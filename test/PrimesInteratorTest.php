<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 21:24
 */

namespace AnaNTest;


use AnaN\Prime\PrimesInterator;

class PrimesInteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testIteration()
    {
        $it = new PrimesInterator();

         foreach($it as $key => $value){
             if($key == 10000){

                 $this->assertEquals(104743,$value);
                 break;
             }
         }


    }

}
