<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/8/30
 * Time: 下午7:50
 */

class ArrayList
{

    private $data = [];
    private $size = 0;

    // 构造函数，传入数组的容量capacity构造Array
    public function __construct($capacity = 10)
    {
        $this->data = new \SplFixedArray($capacity);
        $this->size = 0;
    }

    // 获取数组的容量
    public function getCapacity()
    {
        return $this->data->count();
    }

    // 获取数组中的元素个数
    public function getSize()
    {
        return $this->size;
    }

    // 返回数组是否为空
    public function isEmpty()
    {
        return $this->size == 0;
    }

    // 在index索引的位置插入一个新元素e
    public function add($index, $e)
    {

        if($index < 0 || $index > $this->size) {
            throw new \Exception('Add failed. Require index >= 0 and index <= size.');
        }

        $length = $this->getCapacity();

        if ($this->size == $length) {
            $this->resize(2 * $length);
        }

        for($i = $this->size - 1; $i >= $index ; $i --) {

            $this->data[$i + 1] = $this->data[$i];

        }

        $this->data[$index] = $e;
        $this->size++;
    }

    // 向所有元素后添加一个新元素
    public function addLast ($e)
    {
        $this->add($this->size, $e);
    }

    // 在所有元素前添加一个新元素
    public function addFirst($e)
    {
        $this->add(0, $e);
    }

    // 获取index索引位置的元素
    public function get($index)
    {
        if($index < 0 || $index >= $this->size) {
            throw new \Exception("Get failed. Index is illegal.");

        }
        return $this->data[$index];
    }

    public function getLast()
    {
        return $this->get($this->size-1);
    }

    public function getFirst()
    {
        return $this->get(0);
    }

    // 修改index索引位置的元素为e
    public function set($index, $e)
    {
        if($index < 0 || $index >= $this->size)
        {
            throw new \Exception("Set failed. Index is illegal.");
        }
        $this->data[$index] = $e;
    }


    // 查找数组中是否有元素e
    public function contains($e)
    {
        for($i = 0; $i < $this->size; $i++)
        {
            if($this->data[$i] == $e) {
                return true;
            }
        }
        return false;
    }


    // 查找数组中元素e所在的索引，如果不存在元素e，则返回-1
    public function find($e)
    {
        for($i = 0; $i < $this->size; $i++)
        {
            if($this->data[$i] == $e) {
                return $i;
            }
        }
        return -1;
    }

    // 从数组中删除index位置的元素, 返回删除的元素
    public function remove($index)
    {
        if($index < 0 || $index >= $this->size) {

            throw new \Exception("Remove failed. Index is illegal.");
        }

        $ret = $this->data[$index];

        for($i = $index + 1; $i < $this->size; $i++) {

            $this->data[$i - 1] = $this->data[$i];
        }

        $this->size --;

        $this->data[$this->size] = null;

        $length = $this->getCapacity();

        if($this->size == (int) ($length / 4) && (int) ($length / 2) != 0)
        {
            $this->resize((int) ($length / 2));

        }

        return $ret;

    }


    // 从数组中删除第一个元素, 返回删除的元素
    public function removeFirst()
    {
        return $this->remove(0);
    }

    // 从数组中删除最后一个元素, 返回删除的元素
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    // 从数组中删除元素e
    public function removeElement($e)
    {
        $index = $this->find($e);

        if($index != -1)
        {
            $this->remove($index);
        }
    }


    // 将数组空间的容量变成newCapacity大小
    private function resize($newCapacity)
    {
        $newData = new \SplFixedArray($newCapacity);
        for($i = 0; $i < $this->size; $i++)
        {
            $newData[$i] = $this->data[$i];
        }
        $this->data = $newData;
    }

}








