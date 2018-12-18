<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/9
 * Time: 10:45 AM
 */

try {

    require_once "AVLTree.php";
    require_once "BSTMap.php";

    $file = fopen("pride-and-prejudice.txt", "r") or exit("Unable to open file!");

    $pattern = '/\b[a-zA-Z]+\b/';

    $words = [];

    while (!feof($file)) {

        $str = fgets($file);
        preg_match_all($pattern, $str, $result);

        foreach ($result as $list) {
            foreach ($list as $word) {
                if (empty($word) === false) {
                    $words[] = $word;
                }

            }

        }
    }
    fclose($file);

/*
    让BST退化成链表(树向一边倾斜)， 测试200个元素数据；（php递归层数过深会报错，坑）
    BST: 1.2424430847168
    AVL: 0.1996679306030
*/
/*
    $words = [];
    for($i=1; $i<= 200; $i++) {
        $words[$i] = $i;
    }
*/





    // Test BST
    $startTime = microtime(true);
    $bst = new BSTMap();

    foreach ($words as $word) {

        if ($bst->contains($word)) {
            $bst->set($word, $bst->get($word) + 1);
        } else {
            $bst->add($word, 1);
        }

    }

    $endTime = microtime(true);
    echo "BST: " . ($endTime - $startTime).PHP_EOL;


    // Test AVL Tree
    $startTime = microtime(true);
    $avl = new AVLTree();

    foreach ($words as $word) {

        if ($avl->contains($word)) {
            $avl->set($word, $avl->get($word) + 1);
        } else {
            $avl->add($word, 1);
        }

    }
    $endTime = microtime(true);
    echo "AVL: " . ($endTime - $startTime).PHP_EOL;

    /*
        BST: 105.99728417397
        AVL: 91.69841003418
    */


} catch (Error $error) {

    echo $error->getMessage();

}
