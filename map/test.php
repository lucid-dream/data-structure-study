<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/7
 * Time: 下午8:58
 */

require_once "LinkedListMap.php";
require_once "BSTMap.php";

echo '<pre>';

$map = new LinkedListMap();
$map->add(3, 3);
$map->add(2, 2);
$map->add(1, 1);
print_r($map);
var_dump($map->remove(3));
print_r($map);

echo "<hr>";


$map = new BSTMap();

$map->add(4, 4);
$map->add(2, 2);
$map->add(7, 7);
$map->add(6, 6);
$map->add(10, 10);
$map->add(9, 9);

print_r($map);
//var_dump($map->contains(21));
//var_dump($map->get(6));
//var_dump($map->set(6, 6666666));
$map->remove(7);
print_r($map);