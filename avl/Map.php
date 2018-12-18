<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/7
 * Time: 下午6:46
 */

interface Map
{

    public function add($key, $value): void;

    public function remove($key);

    public function contains($key): bool;

    public function get($key);

    public function set($key, $newValue) : void;

    public function getSize(): int;

    public function isEmpty(): bool;
}