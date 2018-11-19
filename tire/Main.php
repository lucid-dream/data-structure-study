<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 6:02 PM
 */


require_once "Trie.php";

$trie = new Trie();

$trie->add('abcd');
$trie->add('abce');

echo '<pre>';
print_r($trie);

var_dump($trie->contains('abce'));
var_dump($trie->isPrefix('ab'));
