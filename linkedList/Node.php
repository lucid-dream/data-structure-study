<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/12
 * Time: 下午6:59
 */

/**
 * 节点类
 *
 * Class Node
 */
class Node
{
    public $e;
    public $next;

    public function __construct($e = null,  $next = null)
    {
        $this->e = $e;
        $this->next = $next;
    }

}