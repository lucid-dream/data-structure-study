<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/7
 * Time: 下午6:51
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
    public $next; //node

    public function __construct($key = null, $value = null,  $next = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }

}