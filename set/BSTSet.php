<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/30
 * Time: 下午3:07
 */
include_once "Set.php";
include_once "../binarySearchTree/BinarySearchTree.php";

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

    // O(h)  h是树的高度
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
