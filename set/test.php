<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/30
 * Time: 下午3:15
 */
ini_set('memory_limit','1024M');    // 临时设置最大内存占用为1G


try {

//    require_once "LinkedListSet.php";
//    $set = new LinkedListSet();


    require_once "BSTSet.php";
    $set = new BSTSet();

    // 测试复杂度 ，理论上 链表的集合add 复杂度是 o(n) 比 二叉树慢，但实际测试 链表比 二叉树快，
    // todo 未深入查原因，怀疑可能跟递归有关系。
    // todo 二叉树添加元素 递归过深会报 child xxx said into stderr

    $start =  microtime(true);

    for ($i = 0; $i < 50 ; $i++) {
        $arr = range(1, 200);


        foreach ($arr as $val) {

            $set->add($val);

        }

    }

    $end = microtime(true);

    echo $end-$start;


} catch (Exception $exception) {

    echo $exception->getMessage();
}





