<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/26
 * Time: 7:58 PM
 */


require_once "UnionFind1.php";
require_once "UnionFind2.php";
require_once "UnionFind3.php";
require_once "UnionFind4.php";


try {

    set_time_limit(0);

//    echo "<pre>";

//    $uf1 = new UnionFind1(10);
//
//    print_r($uf1);
//    $uf1->unionElements(1, 2);
//    print_r($uf1);
//    $uf1->unionElements(2, 4);
//    print_r($uf1);

//    $uf2 = new UnionFind2(10);
//    $uf2->unionElements(4, 3);
//    print_r($uf2);
//
//    $uf2->unionElements(3, 8);
//    print_r($uf2);
//
//    $uf2->unionElements(6, 5);
//    print_r($uf2);
//
//    $uf2->unionElements(9, 4);
//    print_r($uf2);


    $size = 1000000;
    $m = 1000000;
    $uf1 = new UnionFind1($size);
    $uf2 = new UnionFind2($size);
    $uf3 = new UnionFind3($size);
    $uf4 = new UnionFind4($size);

    echo "Testing size {$size}, m {$m}". PHP_EOL;

    echo "UF1:". testUF($uf1, $m). PHP_EOL;
    echo "UF2:". testUF($uf2, $m). PHP_EOL;
    echo "UF3:". testUF($uf3, $m). PHP_EOL;
    echo "UF4:". testUF($uf4, $m). PHP_EOL;

    /*
    时间复杂度测试：
    Testing size 1000, m 1000
    UF1:9.3148510456085
    UF2:0.14576482772827
    UF3:0.11678194999695
    UF4:0.1142041683197

    Testing size 10000, m 10000
    UF2:4.6942520141602
    UF3:1.1248331069946

    Testing size 10000, m 10000
    UF2:4.6293981075287
    UF3:1.1758089065552
    UF4:1.1527609825134

    Testing size 100000, m 100000
    UF3:11.525384902954
    UF4:11.349576950073

    Testing size 1000000, m 1000000
    UF3:128.67582011223
    UF4:122.67266702652
    */




} catch (Error $error) {

    echo $error->getMessage();

}


function testUF(UF $uf, int $m)
{

    $size = $uf->getSize() - 1;

    $startTime = microtime(true);

    for ($i = 0; $i < $m; $i++) {

        $a = mt_rand(0, $size);
        $b = mt_rand(0, $size);

        $uf->unionElements($a, $b);

    }

    for ($i = 0; $i < $m; $i++) {

        $a = mt_rand(0, $size);
        $b = mt_rand(0, $size);
        $uf->isConnected($a, $b);
    }

    $endTime = microtime(true);

    return $endTime - $startTime;
}



