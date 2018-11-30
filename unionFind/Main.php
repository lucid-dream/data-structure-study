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
require_once "UnionFind5.php";
require_once "UnionFind6.php";


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
    $uf5 = new UnionFind5($size);
    $uf6 = new UnionFind6($size);

    echo "Testing size:{$size}, m:{$m}". PHP_EOL;

    echo "UF1:". testUF($uf1, $m). PHP_EOL;
    echo "UF2:". testUF($uf2, $m). PHP_EOL;
    echo "UF3:". testUF($uf3, $m). PHP_EOL;
    echo "UF4:". testUF($uf4, $m). PHP_EOL;
    echo "UF5:". testUF($uf5, $m). PHP_EOL;
    echo "UF6:". testUF($uf6, $m). PHP_EOL;

    /*
        Testing size:1000, m:1000
        UF1:9.5597779750824
        UF2:0.14099717140198
        UF3:0.11234498023987
        UF4:0.11424899101257
        UF5:0.11105513572693
        UF6:0.14853310585022


        Testing size:10000, m:10000
        UF2:4.3511121273041
        UF3:1.0315790176392
        UF4:1.0441451072693
        UF5:1.0624248981476
        UF6:1.3910329341888


        Testing size:100000, m:100000
        UF3:11.611232995987
        UF4:12.30042386055
        UF5:11.065513134003
        UF6:14.918389081955


        Testing size:1000000, m:1000000
        UF3:112.86260890961
        UF4:118.67182612419
        UF5:115.47334289551
        UF6:143.07465600967 //递归有额外开销

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



