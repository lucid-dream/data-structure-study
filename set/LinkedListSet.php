<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/30
 * Time: 下午7:23
 */

require_once "Set.php";
require_once "../linkedList/LinkedList.php";

class LinkedListSet implements Set
{

    private $list;

    public function __construct()
    {
        $this->list = new LinkedList;
    }

    public function getSize() : int
    {
        return $this->list->getSize();
    }

    public function isEmpty() : bool
    {
        return $this->list->isEmpty();
    }

    // O(n)
    public function add($e) : void
    {
        if (!$this->list->contains($e)) {  // O(n)
            $this->list->addFirst($e); // O(1)
        }

    }

    // O(n)
    public function contains($e) : bool
    {
        return $this->list->contains($e);
    }

    // O(n)
    public function remove($e) : void
    {
       $this->list->removeElement($e);
    }


}


