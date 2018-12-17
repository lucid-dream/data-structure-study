<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/9
 * Time: 10:45 AM
 */

try {


    require_once "AVLTree.php";

    $avl = new AVLTree();

    /*  LL
        $avl->add(9, 1);
        $avl->add(8, 1);
        $avl->add(7, 1);
    */

    /*  RR
        $avl->add(7, 1);
        $avl->add(8, 1);
        $avl->add(9, 1);
    */

    /*  LR
        $avl->add(8, 1);
        $avl->add(1, 1);
        $avl->add(5, 1);
    */

    $avl->add(5, 1);
    $avl->add(9, 1);
    $avl->add(7, 1);


    echo "<pre>";

    var_dump($avl->isBalanced());

    print_r($avl);

} catch (Error $error) {

    echo $error->getMessage(); die;

}
