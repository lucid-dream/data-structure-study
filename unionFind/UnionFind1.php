<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/26
 * Time: 7:49 PM
 */

// 数组版 Union-Find
require_once "UF.php";

class UnionFind1 implements UF
{

    private $id; // int[]

    public function __construct(int $size)
    {

        $this->id = new SplFixedArray($size);

        // 初始化, 每一个id[i]指向自己, 没有合并的元素
        for ($i = 0; $i < $size; $i++) {
            $this->id[$i] = $i; // 元素 => 集合编号
        }

    }

    // 合并元素p和元素q所属的集合, O(n) 复杂度
    public function unionElements(int $p, int $q) : void
    {

        $pID = $this->find($p);
        $qID = $this->find($q);

        // 查找的2个元素属于同一个集合
        if ($pID == $qID) {
            return;
        }

        // 合并过程需要遍历一遍所有元素, 将两个元素的所属集合编号合并
        for ($i = 0; $i < $this->id->count(); $i++) {

            if ($this->id[$i] == $pID) {
                $this->id[$i] = $qID;
            }

        }
    }

    // 查找元素p所对应的集合编号  // O(1)复杂度
    private function find(int $p) : int
    {
        if (isset($this->id[$p]) === false) {
            exit("p is out of bound.");
        }
        return $this->id[$p];
    }


    // 查看元素p和元素q是否所属一个集合, O(1)复杂度
    public function isConnected(int $p, int $q) : bool
    {
        return $this->find($p) == $this->find($q);
    }


    public function getSize() : int
    {
        return $this->id->count();
    }





}