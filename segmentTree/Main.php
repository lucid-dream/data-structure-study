<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/13
 * Time: 上午9:57
 */

require_once "SegmentTree.php";
require_once "SumMerger.php";

try {

    $nums = [-2, 0, 3, -5, 2, -1];

    $merger = new SumMerger();

    $tree = new SegmentTree($nums, $merger);


    var_dump($tree->query(0, 3));

    // 已更改 下标[5] 值为 2 为例， 在右子树中查找，逐个更新 下标[6] => 2 ，[2] => -1, [0] => 0
    var_dump($tree->set(5, 2));

    var_dump($tree);

} catch (Exception $exception) {

    echo $exception->getMessage();
} catch (Error $exception) {

    echo $exception->getMessage();

}


/*
 *                        构建线段树
 *                    [-2, 0, 3, -5, 2, -1] (0)
 *                 /                            \
 *          [-2, 0, 3] (1)                  [-5, 2, -1] (2)
 *           /        \                     /           \
 *      [-2, 0](3)   [3](4)             [-5, 2](5)      [-1](6)
 *    /      \       /   \             /    \           /       \
 * [-2](7)  [0](8) Nil[9] Nil[10]  [-5](11) [2](12)   Nil(13) Nil(14)
*/

//object(SplFixedArray) 构建后的求和结果
//      public 0 => int -3
//      public 1 => int 1
//      public 2 => int -4
//      public 3 => int -2
//      public 4 => int 3
//      public 5 => int -3
//      public 6 => int -1
//      public 7 => int -2
//      public 8 => int 0
//      public 9 => null
//      public 10 => null
//      public 11 => int -5
//      public 12 => int 2
//      public 13 => null
//      public 14 => null

