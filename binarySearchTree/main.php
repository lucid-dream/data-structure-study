<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/18
 * Time: 下午12:20
 */

include_once "BinarySearchTree.php";

$tree = new BinarySearchTree();

$nums = [5, 3, 6, 8, 4, 2];

foreach ($nums as $num) {

    // 添加元素
    $tree->add($num);

}

// 测试是否包含元素
$tree->contains(4);

/////////////////
//      5      //
//    /   \    //
//   3    6    //
//  / \    \   //
// 2  4     8  //
/////////////////

echo '<pre>';

print_r($tree);

echo "<hr>";
$tree->preOrder(); // 前序遍历 5 -> 3 -> 2 -> 4 -> 6 -> 8
echo "<hr>";
$tree->preOrderNR(); // 前序遍历 5 -> 3 -> 2 -> 4 -> 6 -> 8

echo "<hr>";
$tree->inOrder(); // 中序遍历  2 -> 3 -> 4 -> 5 -> 6 -> 8

echo "<hr>";
$tree->postOrder(); // 后序遍历 2 -> 4 -> 3 -> 8 -> 6 -> 5

echo "<hr>";
$tree->levelOrder();




