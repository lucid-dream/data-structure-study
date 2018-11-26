<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/26
 * Time: 7:47 PM
 */

interface UF
{
    public function getSize() : int;
    public function isConnected(int $p, int $q) : bool;
    public function unionElements(int $p, int $q) : void;
}