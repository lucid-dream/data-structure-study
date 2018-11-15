<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/10
 * Time: 下午8:46
 */

require_once "SumMerger.php";

class SegmentTree
{

    private $tree = [];
    private $data = [];
    private $merger; //Merger

    public function __construct(array $arr = [], Merger $merger)
    {
        $this->merger = $merger;

        $this->data = $arr;

        $this->tree = new SplFixedArray(count($arr) * 4); //4N空间

        /**
         *
         *      假设最好结果 n个元素是 2的幂次方， 例如 2^3 = 8个元素，则需要 （2^3） + （2^2+2^1+2^0） ~= 8*2 = 2N
         *      假设最坏结果 2^3 + 1 则需要  (2^4) + (2^3） +（2^2+2^1+2^0） ~= 4N
         *
         *
         *                 [0~7]
         *              /         \
         *       [0,1,2,3]      [4,5,6,7]
         *         / \          /       \
         *    [0,1]   [2,3]   [4,5]     [6,7]
         *   / \       / \    /  \      /  \
         * [0] [1]   [2] [3] [4][5]    [6] [7]
         */


        $this->buildSegmentTree(0, 0, count($arr) - 1);
    }

    // 在treeIndex的位置创建表示区间[l...r]的线段树
    private function buildSegmentTree(int $treeIndex, int $l, int $r) : void
    {
        if ($l == $r) {
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        $mid = ($l + $r) / 2;  // $mid = $l + ($r - $l) / 2;
        $mid = (int) $mid;

        $this->buildSegmentTree($leftTreeIndex, $l, $mid);
        $this->buildSegmentTree($rightTreeIndex, $mid + 1, $r);

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);

    }

    public function getSize(): int
    {
        return count($this->data);
    }

    public function get(int $index)
    {
        if (isset($this->data[$index]) === false) {
            exit("Index is illegal.");
        }
        return $this->data[$index];
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的左孩子节点的索引
    private function leftChild(int $index): int
    {
        return 2 * $index + 1;
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的右孩子节点的索引
    private function rightChild(int $index): int
    {
        return 2 * $index + 2;
    }

    // 返回区间[queryL, queryR]的值
    public function query(int $queryL, int $queryR)
    {

        if (isset($this->data[$queryL]) === false ||
            isset($this->data[$queryR]) === false ||
            $queryL > $queryR
        ) {
            exit('Index is illegal.');
        }

        return $this->queryValue(0, 0, count($this->data) - 1, $queryL, $queryR);
    }


    // 在以treeIndex为根的线段树中[l...r]的范围里，搜索区间[queryL...queryR]的值
    private function queryValue(int $treeIndex, int $l, int $r, int $queryL, int $queryR)
    {

        if($l == $queryL && $r == $queryR) {
            return $this->tree[$treeIndex];
        }


        $mid = ($l + $r) / 2;  // $mid = $l + ($r - $l) / 2;
        $mid = (int) $mid;
        // treeIndex的节点分为[l...mid]和[mid+1...r]两部分

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if($queryL >= $mid + 1) {
            return $this->queryValue($rightTreeIndex, $mid + 1, $r, $queryL, $queryR);

        } elseif($queryR <= $mid) {

            return $this->queryValue($leftTreeIndex, $l, $mid, $queryL, $queryR);

        }

        $leftResult = $this->queryValue($leftTreeIndex, $l, $mid, $queryL, $mid);
        $rightResult = $this->queryValue($rightTreeIndex, $mid + 1, $r, $mid + 1, $queryR);
        return $this->merger->merge($leftResult, $rightResult);
    }


}
