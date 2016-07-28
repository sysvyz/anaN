<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 21:10
 */

namespace AnaN\Prime;


class PrimesInterator implements \Iterator
{

    static protected $primes = [2,3];
    private $index =0;



    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return self::$primes[$this->index];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->index++;

        $next = end(self::$primes);

        while($this->index >= count(self::$primes)){

            $next+=2;
            $isPrime = true;
            $sqrt = floor(sqrt($next));
            foreach (self::$primes as $prime){
                if($next % $prime == 0){
                    $isPrime = false;
                    break;
                }

                if($prime > $sqrt){
                    break;
                }

            }
            if($isPrime){
                self::$primes[] = $next;
            }



        }

    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return true;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->index = 0;
    }
}