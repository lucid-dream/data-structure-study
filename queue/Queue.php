<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/10
 * Time: 下午6:46
 */

interface Queue
{
    public function getSize();
    public function isEmpty();
    public function enqueue($e);
    public function dequeue();
    public function getFront();
}
