<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/30
 * Time: 下午3:04
 */

interface Set
{
    public function add($e) : void ;
    public function contains($e) : bool;
    public function remove($e) : void ;
    public function getSize() : int ;
    public function isEmpty() : bool;
}
