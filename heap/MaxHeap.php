<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/10
 * Time: 上午10:23
 */

class MaxHeap
{

    private $data = []; // array

    public function __construct(array $arr = [])
    {
        $this->data = $arr;
    }

//    public MaxHeap(E[] arr){
//        data = new Array<>(arr);
//        for(int i = parent(arr.length - 1) ; i >= 0 ; i --)
//            siftDown(i);
//    }

    // 返回堆中的元素个数
    public function size() : int
    {
        return count($this->data);
    }

    // 返回一个布尔值, 表示堆中是否为空
    public function isEmpty() : bool
    {
        return empty($this->data);
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的父亲节点的索引
    public function parent(int $index): int
    {
        if ($index == 0) {
            exit("index-0 doesn't have parent.");
        }
        $k = (int) (($index - 1) / 2);
        return $k;
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的左孩子节点的索引
    public function leftChild(int $index) : int
    {
        return $index * 2 + 1;
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的右孩子节点的索引
    public function rightChild(int $index) : int
    {
        return $index * 2 + 2;
    }

    // 向堆中添加元素
    public function add($e) : void
    {
        $this->data[] = $e;
        $this->siftUp(count($this->data) - 1);
    }

    // 上浮
    private function siftUp(int $k) : void
    {
        while($k > 0 && $this->data[$this->parent($k)] < $this->data[$k])
        {
            $parentK = $this->parent($k);
            $this->swap($k, $parentK);
            $k = $this->parent($k);
        }
    }

    // 看堆中的最大元素
    public function findMax()
    {
        if(empty($this->data)) {
            exit("Can not findMax when heap is empty.");
        }
        return $this->data[0];
    }

    // 取出堆中最大元素
    public function extractMax()
    {
        $ret = $this->findMax();
        $this->swap(0, count($this->data) - 1); // 数组头和末尾元素互换
        array_pop($this->data); // 删除数组最后一个元素
        $this->siftDown(0);
        return $ret;
    }

    // 下浮
    private function siftDown(int $k) : void
    {

        $size = count($this->data);

        while ($this->leftChild($k) < $size) {

            // 获取左孩子 下标
            $j = $this->leftChild($k);

            // $j+1 右孩子 ，如果右孩子 > 左孩子
            if ($j + 1 < $size &&
                $this->data[$j + 1] > $this->data[$j]) {
                $j++;
            }

            // data[j] 是 leftChild 和 rightChild 中的最大值
            if ($this->data[$k] > $this->data[$j]) {
                break;
            }

            $this->swap($k, $j);
            $k = $j;
        }

    }

    // 取出堆中的最大元素，并且替换成元素e
    public function replace($e)
    {
        $ret = $this->findMax();
        $this->data[0] = $e;
        $this->siftDown(0);
        return $ret;
    }

    //交换
    public function swap(int $i, int $j): void
    {

        if ($i < 0 || $i >= count($this->data) || $j < 0 || $j >= count($this->data)) {
            exit("Index is illegal.");
        }

        $t = $this->data[$i];
        $this->data[$i] = $this->data[$j];
        $this->data[$j] = $t;
    }


}

$heap = new MaxHeap([62, 41, 30, 28, 16, 22 ,13, 19, 17, 15]);


$heap->add(52);


var_dump($heap);

$heap->extractMax();

var_dump($heap);
