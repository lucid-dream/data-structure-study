<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/7
 * Time: 下午6:50
 */
require_once "Node.php";
require_once "Map.php";

class LinkedListMap implements Map
{

    private $dummyHead; //Node
    private $size;

    public function __construct()
    {
        $this->dummyHead = new Node();
        $this->size = 0;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isEmpty(): bool
    {
        return $this->size == 0;
    }

    private function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            if ($cur->key == $key) {
                return $cur;
            }
            $cur = $cur->next;
        }
        return null;
    }

    public function contains($key): bool
    {
        return $this->getNode($key) != null;
    }

    public function get($key)
    {
        $node = $this->getNode($key);
        return $node ? $node->value : null;
    }

    public function add($key, $value): void
    {
        $node = $this->getNode($key);
        if ($node == null) {
            $this->dummyHead->next = new Node($key, $value, $this->dummyHead->next);
            $this->size++;
        } else {
            // 如果存在key,则更新value
            $node->value = $value;
        }
    }

    public function set($key, $newValue): void
    {
        $node = $this->getNode($key);
        if ($node == null) {
            exit("{$key} doesn't exist!");
        }

        $node->value = $newValue;
    }

    public function remove($key)
    {

        $prev = $this->dummyHead;
        while ($prev->next != null) {
            if ($prev->next->key == $key) {
                break;
            }
            $prev = $prev->next;
        }

        if ($prev->next != null) {
            $delNode = $prev->next;
            $prev->next = $delNode->next;
            $delNode->next = null;
            $this->size--;
            return $delNode->value;
        }

        return null;
    }


}