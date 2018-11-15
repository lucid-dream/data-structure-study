<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/10
 * Time: 下午9:09
 */

require_once "Merger.php";

class SumMerger implements Merger
{
    public function merge(int $a, int $b) : int
    {
        return $a + $b;
    }
}
