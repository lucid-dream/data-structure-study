<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/27
 * Time: 7:37 AM
 */

// 树版 Union-Find
require_once "UF.php";

class UnionFind2 implements UF
{

    // 使用一个数组构建一棵指向父节点的树
    // parent[i]表示第一个元素所指向的父节点
    private $parent; // int[]

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);

        // 初始化, 每一个parent[i]指向自己, 表示每一个元素自己自成一个集合
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i; // 元素 => 集合编号
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

        $this->parent[$pRoot] = $qRoot; //改变根元素的集合
    }

    public function getSize(): int
    {
        return $this->parent->count();
    }


}