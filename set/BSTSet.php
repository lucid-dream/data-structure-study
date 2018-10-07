<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/30
 * Time: 下午3:07
 */
include_once "Set.php";
include_once "../binarySearchTree/BinarySearchTree.php";

/**
 * Class BSTSet
 *
    满二叉树
///////////////// 深度
//      5      //  0
//    /   \    //
//   3    6    //  1
//  / \  / \   //
// 2  4 7   8  //  2
/////////////////
 *
 * 复杂度 O(h) 假设 h是树的深度，从根节点 0 开始
 * 2^0 + 2^1 + 2^2 = 1+2+4 = 7
 * 2^3 - 1 = 8 - 1 = 7
 * 2^3 = log2(8)
 *
 * 满二叉树 h层共有 2^h-1 = n 的节点，
 * 复杂度 h+1 = log2(n) => O(log2n) => O(logn)
 *
 *
 */
class BSTSet implements Set
{

    private $bst;

    public function __construct()
    {
        $this->bst = new BinarySearchTree();
    }

    public function getSize() : int
    {
        return $this->bst->getSize();
    }

    public function isEmpty() : bool
    {
        return $this->bst->isEmpty();
    }

    // O(h)
    public function add($e) : void
    {
        $this->bst->add($e);
    }

    // O(h)
    public function contains($e) : bool
    {
        return $this->bst->contains($e);
    }

    // O(h)
    public function remove($e) : void
    {
        $this->bst->remove($e);
    }


}
