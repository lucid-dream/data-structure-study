<?php


// 树版 Union-Find，基于size的优化
require_once "UF.php";

class UnionFind3 implements UF
{

    // 使用一个数组构建一棵指向父节点的树
    // parent[i]表示第一个元素所指向的父节点
    private $parent = []; // int[]
    private $sz = []; // sz[i]表示以i为根的集合中元素个数

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);
        $this->sz = new SplFixedArray($size);

        // 初始化, 每一个parent[i]指向自己, 表示每一个元素自己自成一个集合
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i; // 元素 => 集合编号
            $this->sz[$i] = 1; // $this->sz[$i] = count($this->parent[$i]);
        }

    }

    // 查找过程, 查找元素p所对应的集合编号，O(h)复杂度, h为树的高度
    private function find(int $p) : int
    {

        if (isset($this->parent[$p]) === false) {
            exit("p is out of bound.");
        }

        // 不断去查询自己的父亲节点, 直到到达根节点
        // 根节点的特点: parent[p] == p, 如果 parent[p] != p, 说明有父亲节点
         while($p != $this->parent[$p]) {
             $p = $this->parent[$p];
         }
         return $p;
    }

    // 查看元素p和元素q是否所属一个集合，O(h)复杂度, h为树的高度
    public function isConnected(int $p, int $q) : bool
    {
        return $this->find($p) == $this->find($q);
    }

    // 合并元素p和元素q所属的集合，O(h)复杂度, h为树的高度
    public function unionElements(int $p, int $q) : void
    {

        $pRoot = $this->find($p); //获取p元素的 根节点
        $qRoot = $this->find($q); //获取q元素的 根节点

        //属于同一个集合
        if($pRoot == $qRoot) {
            return;
        }

        // 根据两个元素所在树的元素个数不同判断合并方向

        // 将元素个数少的集合合并到元素个数多的集合上, 并更新 树的size
        if($this->sz[$pRoot] < $this->sz[$qRoot]) {

            $this->parent[$pRoot] = $qRoot;
            $this->sz[$qRoot] += $this->sz[$pRoot];

        } else { // sz[qRoot] <= sz[pRoot]

            $this->parent[$qRoot] = $pRoot;
            $this->sz[$pRoot] += $this->sz[$qRoot];

        }

    }

    public function getSize(): int
    {
        return $this->parent->count();
    }


}