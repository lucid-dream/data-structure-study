<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/4
 * Time: 下午10:24
 */

interface Stack
{
    public function getSize();
    public function isEmpty();
    public function push($e);
    public function pop();
    public function peek();
}

