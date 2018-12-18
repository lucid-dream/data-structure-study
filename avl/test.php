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
    echo "BST: " . ($endTime - $startTime);


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
    echo "AVL: " . ($endTime - $startTime);


} catch (Error $error) {

    echo $error->getMessage();

}
