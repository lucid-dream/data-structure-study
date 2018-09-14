<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/12
 * Time: 下午6:57
 */

include 'Node.php';

class LinkedList
{

    private $dummyHead = null;
    private $size = 0;

    public function __construct()
    {
        $this->dummyHead = new Node(); //虚拟头节点
        $this->size = 0;
    }

    // 获取链表中的元素个数
    public function getSize()
    {
        return $this->size;
    }

    // 返回链表是否为空
    public function isEmpty()
    {
        return $this->size === 0;
    }

    /*
     *  在链表的index(0-based)位置添加新的元素e
     *  在链表中不是一个常用的操作
     *  addLast 操作， 循环对象 引用赋值，$prev 循环指向末尾的node对象
     *  addFirst 操作，每次把 虚拟节点的当前 next 值(node对象)，传入 新实例 node类中，并把 虚拟节点的 next 指向 新的实例node对象中
     *
    */
    public function add(int $index, $e)
    {

        if ($index < 0 || $index > $this->size) {
            throw new Exception("Add failed. Illegal index.");
        }

        $prev = $this->dummyHead; // 对象 引用赋值

        for ($i = 0 ; $i < $index; $i ++) {
            $prev = $prev->next; //
        }

        $prev->next = new Node($e, $prev->next);
        $this->size ++;
    }

    // 在链表头添加新的元素e
    public function addFirst($e)
    {
        $this->add(0, $e);
    }

    // 在链表末尾添加新的元素e
    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    // 获得链表的第index(0-based)个位置的元素
    // 在链表中不是一个常用的操作
    public function get($index)
    {

        if ($index < 0 || $index >= $this->size) {
            throw new Exception("Get failed. Illegal index.");
        }

        $cur = $this->dummyHead->next;

        for ($i = 0 ; $i < $index ; $i ++) {

            $cur = $cur->next;

        }
        return $cur->e;
    }

    // 获得链表的第一个元素
    public function getFirst()
    {
        return $this->get(0);
    }

    // 获得链表的最后一个元素
    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    // 修改链表的第index(0-based)个位置的元素为e
    public function set(int $index, $e)
    {
        if ($index < 0 || $index >= $this->size) {

            throw new Exception("Set failed. Illegal index.");

        }

        $cur = $this->dummyHead->next;
        for($i = 0 ; $i < $index ; $i ++) {
            $cur = $cur->next;
        }
        $cur->e = $e;
    }

    // 查找链表中是否有元素e
    public function contains($e)
    {
        $cur = $this->dummyHead->next;

        while ($cur != null) {

            if ($cur->e == $e) {
                return true;
            }

            $cur = $cur->next;
        }
        return false;
    }

    // 从链表中删除index(0-based)位置的元素, 返回删除的元素
    // 在链表中不是一个常用的操作
    public function remove(int $index)
    {
        if($index < 0 || $index >= $this->size) {
            throw new Exception("Remove failed. Index is illegal.");
        }

        $prev = $this->dummyHead;

        for($i = 0 ; $i < $index ; $i ++) {
            $prev = $prev->next;
        }

        $retNode = $prev->next;
        $prev->next = $retNode->next;
        $retNode->next = null;
        $this->size --;
        return $retNode->e;
    }

    // 从链表中删除第一个元素, 返回删除的元素
    public function removeFirst()
    {
        return $this->remove(0);
    }

    // 从链表中删除最后一个元素, 返回删除的元素
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

}

//try {
//
//    $link = new LinkedList();
//
//    $link->addFirst(1);
//    $link->addFirst(2);
//    $link->addLast(3);
//
//    echo '<pre>';
//    print_r($link);
//
//    $link->removeLast();
//
//    print_r($link);
//
//
//} catch (Exception $exception) {
//
//    echo $exception->getMessage();
//
//}

