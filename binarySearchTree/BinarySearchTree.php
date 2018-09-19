<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/18
 * Time: 下午12:00
 */

include_once "Node.php";

class BinarySearchTree
{

    private $root; //Node 根节点
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    // 向二分搜索树中添加新的元素e
    public function add($e)
    {
        $this->root = $this->addNode($this->root, $e);
    }

    // 向以node为根的二分搜索树中插入元素e，递归算法
    // 返回插入新节点后二分搜索树的根
    private function addNode($node, $e) : Node
    {
        if ($node == null) {
            $this->size++;
            return new Node($e);
        }

//        if (bccomp($e, $node->e) == -1) {
//
//            $node->left = $this->addNode($node->left, $e);
//
//        } elseif (bccomp($e, $node->e) == 1) {
//
//            $node->right = $this->addNode($node->right, $e);
//
//        }

        if (strcmp($e, $node->e) < 0) {

            $node->left = $this->addNode($node->left, $e);

        } elseif (strcmp($e, $node->e) > 0) {

            $node->right = $this->addNode($node->right, $e);

        }


        return $node;
    }

    // 看二分搜索树中是否包含元素e
    public function contains($e)
    {
        return $this->containsElement($this->root, $e);
    }

    // 看以node为根的二分搜索树中是否包含元素e, 递归算法
    private function containsElement($node, $e) : bool
    {

        if($node == null) {
            return false;
        }

        if (strcmp($e, $node->e) == 0) {

            return true;

        } elseif (strcmp($e, $node->e) < 0) {

            return $this->containsElement($node->left, $e);

        } elseif (strcmp($e, $node->e) > 0) {

            return $this->containsElement($node->right, $e);

        }

    }


    // 二分搜索树的前序遍历
    public function preOrder()
    {
        $this->preOrderNode($this->root);
    }

    // 前序遍历以node为根的二分搜索树, 递归算法
    // 根结点 ---> 左子树 ---> 右子树
    private function preOrderNode($node)
    {
        if ($node == null) {
            return;
        }

        echo $node->e . PHP_EOL;
        $this->preOrderNode($node->left);
        $this->preOrderNode($node->right);
    }

    // 二分搜索树的中序遍历
    public function inOrder()
    {
        $this->inOrderNode($this->root);
    }

    // 中序遍历以node为根的二分搜索树, 递归算法
    // 左子树---> 根结点 ---> 右子树 （顺序/升序 遍历）
    private function inOrderNode($node)
    {
        if ($node == null) {
            return;
        }

        $this->inOrderNode($node->left);
        echo $node->e . PHP_EOL;
        $this->inOrderNode($node->right);
    }


    // 二分搜索树的后序遍历
    // 左子树 ---> 右子树 ---> 根结点
    public function postOrder()
    {
        $this->postOrderNode($this->root);
    }

    // 后序遍历以node为根的二分搜索树, 递归算法
    private function postOrderNode($node)
    {
        if ($node == null) {
            return;
        }

        $this->preOrderNode($node->left);
        $this->preOrderNode($node->right);
        echo $node->e . PHP_EOL;
    }




}



