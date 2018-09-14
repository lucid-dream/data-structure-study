<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/14
 * Time: 下午4:26
 */

include 'Queue.php';
include '../linkedList/Node.php';

class LinkedListQueue implements Queue
{

    private $head, $tail; //头指针，尾指针
    private $size;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->size = 0;
    }

    public function getSize() : int
    {
        return $this->size;
    }

    public function isEmpty() : bool
    {
        return $this->size == 0;
    }

    // 从链表尾部入队 O(1)
    public function enqueue($e)
    {
        if ($this->tail == null) {

            $this->tail = new Node($e);
            $this->head = $this->tail;

        } else {

            $this->tail->next = new Node($e); // 由于对象是引用赋值，该步骤 $this->head 也会改变
            $this->tail = $this->tail->next; // 覆盖尾部数据

        }

        $this->size ++;
    }

    // 从链表头部出队 O(1)
    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new Exception("Cannot dequeue from an empty queue.");
        }

        $retNode = $this->head;
        $this->head = $this->head->next;

        $retNode->next = null;

        if ($this->head == null) {
            $this->tail = null;
        }
        
        $this->size --;
        return $retNode->e;
    }

    public function getFront()
    {
        if($this->isEmpty()) {
            throw new Exception("Queue is empty.");
        }
        return $this->head->e;
    }

}



