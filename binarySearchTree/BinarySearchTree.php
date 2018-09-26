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
    public function postOrder()
    {
        $this->postOrderNode($this->root);
    }

    // 后序遍历以node为根的二分搜索树, 递归算法
    // 左子树 ---> 右子树 ---> 根结点
    private function postOrderNode($node)
    {
        if ($node == null) {
            return;
        }

        $this->postOrderNode($node->left);
        $this->postOrderNode($node->right);
        echo $node->e . PHP_EOL;
    }

    // 二分搜索树的非递归前序遍历
    public function preOrderNR()
    {
        $stack = new splstack();
        $stack->push($this->root);
        while (!$stack->isEmpty()) {
            $cur = $stack->pop();
            echo $cur->e. '->';
            if ($cur->right != null) {
                $stack->push($cur->right);
            }
            if ($cur->left != null) {
                $stack->push($cur->left);
            }
        }
    }

    // 二分搜索树的层序遍历
    public function levelOrder() : void
    {

        $queue = new SplQueue();
        $queue->enqueue($this->root);
        while (!$queue->isEmpty()) {

            $cur = $queue->dequeue();
            echo $cur->e . '=>';
            if ($cur->left != null) {
                $queue->enqueue($cur->left);
            }
            if ($cur->right != null) {
                $queue->enqueue($cur->right);
            }
        }
    }


    // 寻找二分搜索树的最小元素
    public function minimum()
    {
        if ($this->size == 0) {
            exit("BST is empty");
        }

        $minNode = $this->minimumNode($this->root);
        return $minNode->e;
    }

    // 返回以node为根的二分搜索树的最小值所在的节点
    private function minimumNode($node)
    {
        if ($node->left == null) {
            return $node;
        }
        return $this->minimumNode($node->left);
    }


    // 寻找二分搜索树的最大元素
    public function maximum()
    {
        if ($this->size == 0) {
            exit("BST is empty");
        }

        $minNode = $this->maximumNode($this->root);
        return $minNode->e;
    }

    // 返回以node为根的二分搜索树的最大值所在的节点
    private function maximumNode($node)
    {
        if ($node->right == null) {
            return $node;
        }
        return $this->maximumNode($node->right);
    }

    // 从二分搜索树中删除最小值所在节点, 返回最小值
    public function removeMin()
    {
        $ret = $this->minimum();
        $this->root = $this->removeMinNode($this->root);
        return $ret;
    }

    // 删除掉以node为根的二分搜索树中的最小节点
    // 返回删除节点后新的二分搜索树的根
    private function removeMinNode($node)
    {
        if ($node->left == null) {
            // 2 种情况
            // 最小左子树节点元素，该节点下左右子树都为空;
            // 最小左子树节点元素，该节点下左子树为空，右子树不为空，则需要把右子树 覆盖到 当前最小左子树节点元素上。
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }
        $node->left = $this->removeMinNode($node->left);
        return $node;
    }

    // 从二分搜索树中删除最大值所在节点
    public function removeMax()
    {
        $ret = $this->maximum();
        $this->root = $this->removeMaxNode($this->root);
        return $ret;
    }

    // 删除掉以node为根的二分搜索树中的最大节点
    // 返回删除节点后新的二分搜索树的根
    private function removeMaxNode($node)
    {
        if ($node->right == null) {
            $leftNode = $node->left;
            $node->left = null;
            $this->size--;
            return $leftNode;
        }
        $node->right = $this->removeMaxNode($node->right);
        return $node;
    }



}



