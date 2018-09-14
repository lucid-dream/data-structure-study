<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/10
 * Time: 下午6:48
 */

/**
 * 数组队列
 *
 * Class ArrayQueue
 */
include 'Queue.php';
include '../array/ArrayList.php';

class ArrayQueue implements Queue
{

    private $array;

    public function __construct($capacity = 10)
    {
        $this->array = new ArrayList($capacity);
    }

    public function getSize()
    {
        return $this->array->getSize();
    }

    public function isEmpty()
    {
        return $this->array->isEmpty();
    }

    public function getCapacity()
    {
        return $this->array->getCapacity();
    }

    public function enqueue($e)
    {
        $this->array->addLast($e);
    }

    public function dequeue()
    {
        return $this->array->removeFirst();
    }

    public function getFront()
    {
        return $this->array->getFirst();
    }
}

try {

    $queue = new ArrayQueue();
    $queue->enqueue(3);
    $queue->enqueue(1);
    $queue->enqueue(2);
    var_dump($queue);
    var_dump($queue->getFront());
    $queue->dequeue();
    var_dump($queue);die;

} catch (Exception $exception) {

}
