<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 5:29 PM
 */

class Node
{

    public $isWord; //boolean
    public $next; // TreeMap<Character, Node>

    public function __construct(bool $isWord = false)
    {
        $this->isWord = $isWord;
        $this->next = new \Ds\Map();
    }

}