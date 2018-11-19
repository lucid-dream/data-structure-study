<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 5:27 PM
 */

require_once "Node.php";

class Trie
{

    private $root = null; //Node
    private $size = 0;

    public function __construct()
    {
        $this->root = new Node();
        $this->size = 0;
    }

    // 获得Trie中存储的单词数量
    public function getSize(): int
    {
        return $this->size;
    }

    // 向Trie中添加一个新的单词word
    public function add(String $word) : void
    {

        $cur = $this->root;

        for($i = 0 ; $i < strlen($word) ; $i++) {

            $c = $word[$i];

            if ($cur->next->haskey($c) === false) {

                $cur->next->put($c, new Node()); // Key(String) => Value(Node)

            }

            $cur = $cur->next->get($c); //如果 haskey($c) == false, 则该行为Nil

        }

        // 当前 $cur 已经是 单词的最末尾，则标识是 单词
        if ($cur->isWord === false) {

            $cur->isWord = true;
            $this->size++;

        }

    }

    // 查询单词word是否在Trie中
    public function contains(String $word): bool
    {
        $cur = $this->root;

        for($i = 0 ; $i < strlen($word) ; $i++) {

            $c = $word[$i];

            if ($cur->next->haskey($c) === false) {
                return false;
            }

            $cur = $cur->next->get($c);

        }

        return $cur->isWord;
    }

    // 查询是否在Trie中有单词以prefix为前缀
    public function isPrefix(String $prefix) : bool
    {

        $cur = $this->root;

        for($i = 0 ; $i < strlen($prefix) ; $i++) {

            $c = $prefix[$i];

            if ($cur->next->haskey($c) === false) {
                return false;
            }

            $cur = $cur->next->get($c);

        }

        return true;
    }


}