<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/20
 * Time: 8:50 PM
 */

require_once "Map.php";
require_once "../avl/AVLTree.php";


class AVLMap implements Map
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

    public function add($key, $value) : void
    {
        $this->avl->add($key, $value);
    }

    public function contains($key) : bool
    {
        return $this->avl->contains($key);
    }

    public function get($key)
    {
        return $this->avl->get(key);
    }

    public function set($key, $newValue) : void
    {
        $this->avl->set($key, $newValue);
    }

    public function remove($key) : void
    {
        $this->avl->remove($key);
    }

}

