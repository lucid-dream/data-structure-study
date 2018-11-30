<?php


// 树版 Union-Find，基于rank(排行)的优化， 路径压缩
require_once "UF.php";

class UnionFind5 implements UF
{

    // 使用一个数组构建一棵指向父节点的树
    // parent[i]表示第一个元素所指向的父节点
    private $parent = []; // int[]
    private $rank = []; // rank[i]表示以i为根的集合中元素个数

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);
        $this->rank = new SplFixedArray($size);

        // 初始化, 每一个parent[i]指向自己, 表示每一个元素自己自成一个集合
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i; // 元素 => 集合编号
            $this->rank[$i] = 1; // $this->rank[$i] = count($this->parent[$i]);
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

             //路径压缩 只增加该行代码，查找同时改变元素指向的节点，此时并不维护rank值,也不影响
             $this->parent[$p] = $this->parent[$this->parent[$p]];

//               已 find(4) 为例子
//                 ①    ①
//                ②    ②
//               ③    ③ ④
//              ④

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


        //比对2个元素所在树的高度，将rank低的集合合并到rank高的集合上
        if($this->rank[$pRoot] < $this->rank[$qRoot]) {

            $this->parent[$pRoot] = $qRoot;

        } elseif($this->rank[$qRoot] < $this->rank[$pRoot]) {

            $this->parent[$qRoot] = $pRoot;

        } else {  // $this->rank[$pRoot] == $this->rank[$qRoot]

            $this->parent[$pRoot] = $qRoot; // 任意合并也可以 $this->parent[$qRoot] = $pRoot;
            $this->rank[$qRoot] += 1;

//            2个元素所在树如果相同，rank + 1 (高度+1)
//            ①  ③  ①
//            ②  ④  ②③
//                     ④

        }

    }

    public function getSize(): int
    {
        return $this->parent->count();
    }


}