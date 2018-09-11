<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/10
 * Time: 下午8:20
 */

/**
 * 循环队列
 *
 * Class LoopQueue
 */

include 'Queue.php';

class LoopQueue implements Queue
{
    private $data;
    private $front, $tail;
    private $size;

    public function __construct($capacity = 10)
    {
        $this->data = new SplFixedArray($capacity+1);//浪费1个空间
        $this->front = 0;
        $this->tail = 0;
        $this->size = 0;
    }

    public function getCapacity()
    {
        return $this->data->count() - 1;
    }

    public function isEmpty()
    {
        return $this->front === $this->tail; // 都为0情况
    }

    public function getSize()
    {
        return $this->size;
    }

    // 入队
    public function enqueue($e)
    {

        $length = $this->data->count();

        if(($this->tail + 1) % $length == $this->front) {

            $this->resize($this->getCapacity() * 2);

        }

        $this->data[$this->tail] = $e;
        $this->tail = ($this->tail + 1) % $this->data->count();
        $this->size++;

    }

    // 出队
    public function dequeue()
    {

        if ($this->isEmpty()) {
            throw new Exception("Cannot dequeue from an empty queue.");
        }

        $ret = $this->data[$this->front];

        $this->data[$this->front] = null;

        $this->front = ($this->front + 1) % $this->data->count();

        $this->size --;

        $capacity = $this->getCapacity();

        // $capacity 至少为4才缩容
        if($this->size == $capacity / 4 && $capacity / 2 != 0) {

            $this->resize($capacity / 2);

        }
        return $ret;
    }

    public function getFront()
    {
        if ($this->isEmpty()) {
            throw new Exception("Queue is empty.");
        }
        return $this->data[$this->front];
    }

    private function resize($newCapacity)
    {
        $newData = new \SplFixedArray($newCapacity+1);
        for($i = 0; $i < $this->size; $i++) {

            $key = ($i + $this->front) % $this->data->count();
            $newData[$i] = $this->data[$key];
          //  $newData[$i] = $this->data[$i];
        }
        $this->data = $newData;
        $this->front = 0;
        $this->tail = $this->size;
    }
    
}

try {

    $queue = new LoopQueue(4);
    $queue->enqueue(1);
    $queue->enqueue(2);
    $queue->enqueue(3);
    $queue->enqueue(4);

    var_dump($queue);

    var_dump($queue->dequeue());#
    var_dump($queue->dequeue());#
    var_dump($queue->dequeue());#

    var_dump($queue);

} catch (Exception $exception) {

    echo $exception->getMessage();

}