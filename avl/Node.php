<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/8
 * Time: 下午1:26
 */

/**
 * 节点类
 *
 * Class Node
 */
class Node
{
    public $key;
    public $value;
    public $left, $right; //node
    public $height; // 树的高度 int

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }

}