<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/20
 * Time: 8:40 PM
 */

require_once "Set.php";
require_once "../avl/AVLTree.php";

class AVLSet implements Set
{

    private $avl; //AVLTree

    public function __construct()
    {
        $this->avl = new AVLTree();
    }

    public function getSize():int
    {
        return $this->avl->getSize();
    }

    public function isEmpty() : bool
    {
        return $this->avl->isEmpty();
    }

    public function add($e) : void
    {
        $this->avl->add($e, null);
    }

    public function contains($e) : bool
    {
        return $this->avl->contains($e);
    }

    public function remove($e) : void
    {
        $this->avl->remove($e);
    }
}




