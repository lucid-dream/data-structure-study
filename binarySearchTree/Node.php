<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/18
 * Time: 下午12:00
 */

class Node
{
    public $e;
    public $left, $right; //Node

    public function __construct($e)
    {
        $this->e = $e;
        $this->left = null;
        $this->right = null;
    }
}