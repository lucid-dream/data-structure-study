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

    /*  RL
        $avl->add(5, 1);
        $avl->add(9, 1);
        $avl->add(7, 1);
    */

    $avl->add(12, 1);
    $avl->add(8, 1);
    $avl->add(18, 1);
    $avl->add(5, 1);
    $avl->add(11, 1);
    $avl->add(17, 1);
    $avl->add(3, 1);
    $avl->add(7, 1);



//            12
//          /    \
//        ⑧        18
//       / \      /
//      5   11  17
//     / \
//    3   7
//     \
//      4  插入元素4，破坏了平衡性，不平衡节点8 ，向右旋转

    $avl->add(4, 1);

//             12
//          /      \
//         5        18
//       /   \      /
//      3      8   17
//       \    / \
//        4  7   11
//



    echo "<pre>";
    var_dump($avl->isBalanced());

    print_r($avl);

} catch (Error $error) {

    echo $error->getMessage();

}
