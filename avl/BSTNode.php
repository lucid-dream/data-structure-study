<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/8
 * Time: 下午1:26
 */

/**
 * 节点类
 *
 * Class Node
 */
class BSTNode
{
    public $key;
    public $value;
    public $left, $right; //node

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }

}