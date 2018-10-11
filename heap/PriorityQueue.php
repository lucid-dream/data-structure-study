<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/11
 * Time: 下午1:24
 */

require_once "../queue/Queue.php";
require_once "MaxHeap.php";

/**
 * 优先队列
 *
 * Class PriorityQueue
 */
class PriorityQueue implements Queue
{
    private $maxHeap; // MaxHeap

    public function __construct()
    {
        $this->maxHeap = new MaxHeap();
    }

    public function getSize()
    {
        return $this->maxHeap->size();
    }

    public function isEmpty()
    {
        return $this->maxHeap->isEmpty();
    }

    public function getFront()
    {
        return $this->maxHeap->findMax();
    }

    public function enqueue($e)
    {
        $this->maxHeap->add($e);
    }

    public function dequeue()
    {
        return $this->maxHeap->extractMax();
    }


}