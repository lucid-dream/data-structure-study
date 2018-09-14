<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/14
 * Time: 上午11:01
 */

include 'Stack.php';
include '../linkedList/LinkedList.php';

class LinkedListStack implements Stack
{

    private  $list; //LinkedList

    public function __construct()
    {
        $this->list = new LinkedList();
    }

    public function getSize() : int
    {
        return $this->list->getSize();
    }

    public function isEmpty() : bool
    {
        return $this->list->isEmpty();
    }

    public function push($e)
    {
        $this->list->addFirst($e);
    }

    public function pop()
    {
        return $this->list->removeFirst();
    }

    public function peek()
    {
        return $this->list->getFirst();
    }

}

