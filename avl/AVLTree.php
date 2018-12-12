<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/12/8
 * Time: 下午1:26
 */
require_once "Node.php";

class AVLTree
{

    private $root; //Node
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * 获取树的元素个数
     *
     * @author wuyihao <wuyihao@vpgame.cn>
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * 是否是空树
     *
     * @author wuyihao <wuyihao@vpgame.cn>
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->size == 0;
    }

    /**
     * 判断该二叉树是否是一棵二分搜索树
     * @return bool
     */
    public function isBst(): bool
    {
        $keys = [];
        $this->inOrder($this->root, $keys);
        for($i = 1; $i < count($keys); $i++) {
            if(bccomp($keys[$i - 1], $keys[$i]) == 1) {
                return false;
            }
        }
        return true;
    }

    private function inOrder($node, $keys): void
    {
        if ($node == null) {
            return;
        }
        $this->inOrder($node, $keys);
        $this->add($node->key);
        $this->inOrder($node->right);
    }

    // 判断该二叉树是否是一棵平衡二叉树
    public function isBalanced(): bool
    {
        return $this->isBalancedNode($this->root);
    }

// 判断以Node为根的二叉树是否是一棵平衡二叉树，递归算法
    private function isBalancedNode($node): bool
    {

        if ($node == null) {
            return true;
        }

        $balanceFactor = $this->getBalanceFactor($node);
        if (abs($balanceFactor) > 1) {
            return false;
        }
        return $this->isBalancedNode($node->left) && $this->isBalancedNode($node->right);
    }



    /**
     * 获取树的节点高度
     *
     * @return int
     */
    private function getHeight($node) : int
    {
        if ($node == null) {
            return 0;
        }
        return $node->height;
    }

    /**
     * 获取节点node的平衡因子 （任意节点的 左孩子节点高度 - 右孩子节点高度）
     *
     * @param Node $node
     * @return int
     */
    private function getBalanceFactor(Node $node) : int
    {
        if ($node == null) {
            return 0;
        }
        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    /**
     * 向二分搜索树中添加新的元素(key, value)
     *
     * @param $key
     * @param $value
     */
    public function add($key, $value) : void
    {
        $this->root = $this->addNode($this->root, $key, $value);
    }

    /**
     * 向以node为根的二分搜索树中插入元素(key, value)，返回插入新节点后二分搜索树的根
     *
     * @param $node
     * @param $key
     * @param $value
     * @return Node
     */
    private function addNode($node, $key, $value): Node
    {
        if ($node == null) {
            $this->size++;
            return new Node($key, $value);
        }

        if (bccomp($key, $node->key) == -1) {

            $node->left = $this->addNode($node->left, $key, $value);

        } elseif (bccomp($key, $node->key) == 1) {

            $node->right = $this->addNode($node->right, $key, $value);

        } elseif (bccomp($key, $node->key) == 0) {
            // 如果key 存在，则更新
            $node->value = $value;
        }

        //更新节点高度
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));

        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);

        if(abs($balanceFactor) > 1) {
            echo "unbalanced:{$balanceFactor}";
        }

        return $node;
    }

    // 返回以node为根节点的二分搜索树中，key所在的节点
    private function getNode($node, $key)
    {
        if ($node == null) {
            return null;
        }

        if ($key == $node->key) {
            return $node;
        } elseif (bccomp($key, $node->key) == -1) {
            return $this->getNode($node->left, $key);
        } elseif (bccomp($key, $node->key) == 1) {
            return $this->getNode($node->right, $key);
        }

    }

    public function contains($key): bool
    {
        return $this->getNode($this->root, $key) != null;
    }

    public function get($key)
    {
        $node = $this->getNode($this->root, $key);
        return $node ? $node->value : null;
    }

    public function set($key, $newValue): void
    {
        $node = $this->getNode($this->root, $key);
        if ($node == null) {
            exit("{$key} doesn't exist!");
        }
        $node->value = $newValue;
    }

    // 返回以node为根的二分搜索树的最小值所在的节点
    private function minimumNode($node)
    {
        if ($node->left == null) {
            return $node;
        }
        return $this->minimumNode($node->left);
    }

    // 删除掉以node为根的二分搜索树中的最小节点
    // 返回删除节点后新的二分搜索树的根
    private function removeMinNode($node)
    {
        if ($node->left == null) {
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }
        $node->left = $this->removeMinNode($node->left);
        return $node;
    }

    // 从二分搜索树中删除键为key的节点
    public function remove($key)
    {
        $node = $this->getNode($this->root, $key);
        if ($node != null) {
            $this->root = $this->removeNode($this->root, $key);
            return $node->value;
        }
        return null;
    }

    /**
     *
     *  删除掉以node为根的二分搜索树中 key的节点, 递归算法
     *  返回删除节点后新的二分搜索树的根
     */
    public function removeNode($node, $key)
    {

        if ($node == null) {
            return null;
        }

        if (bccomp($key, $node->key) == -1) {

            $node->left = $this->removeNode($node->left, $key);
            return $node;

        } elseif (bccomp($key, $node->key) == 1) {

            $node->right = $this->removeNode($node->right, $key);
            return $node;

        } elseif (bccomp($key, $node->key) == 0) { //相等情况

            // 待删除节点左子树为空的情况
            if ($node->left == null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                return $rightNode;
            }

            // 待删除节点右子树为空的情况
            if ($node->right == null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                return $leftNode;
            }

            // 待删除节点左右子树均不为空的情况

            // 找到比待删除节点大的最小节点, 即待删除节点右子树的最小节点
            // 用这个节点顶替待删除节点的位置
            $successor = $this->minimumNode($node->right);

            $successor->right = $this->removeMinNode($node->right);
            $successor->left = $node->left;

            $node->left = $node->right = null;

            return $successor;
        }
    }


}