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

    private $keys = [];

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * 获取树的元素个数
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * 是否是空树
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->size == 0;
    }

    /**
     * 判断该二叉树是否是一棵二分搜索树
     *
     * @return bool
     */
    public function isBst(): bool
    {
        $this->keys = [];
        $this->inOrder($this->root);

        for ($i = 1; $i < count($this->keys); $i++) {

            //如果 二个相邻的元素，左边下标，大于右边下标，则不是二分搜索树 （因为中序遍历是升序的）
            if (bccomp($this->keys[$i - 1], $this->keys[$i]) == 1) {
                return false;
            }
        }
        return true;
    }

    /**
     * 中序遍历(升序) 并赋值到 keys
     *
     * @param Node|null $node
     */
    private function inOrder(?Node $node): void
    {
        if ($node == null) {
            return;
        }
        $this->inOrder($node->left);
        $this->keys[] = $node->key;
        $this->inOrder($node->right);
    }

    /**
     * 判断该二叉树是否是一棵平衡二叉树
     *
     * @return bool
     */
    public function isBalanced(): bool
    {
        return $this->isBalancedNode($this->root);
    }

    /**
     *
     * 判断以Node为根的二叉树是否是一棵平衡二叉树
     *
     * @param Node|null $node
     * @return bool
     */
    private function isBalancedNode(?Node $node): bool
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
    private function getHeight(?Node $node): int
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
    private function getBalanceFactor(Node $node): int
    {
        if ($node == null) {
            return 0;
        }
        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    // 对节点y进行向右旋转操作，返回旋转后新的根节点x
    //  T1 < z < T2 < x < T3 < y < T4
    //        y                              x
    //       / \                           /   \
    //      x   T4     向右旋转 (y)        z     y
    //     / \       - - - - - - - ->    / \   / \
    //    z   T3                       T1  T2 T3 T4
    //   / \
    // T1   T2
    private function rightRotate(Node $y): Node
    {
        $x = $y->left;
        $T3 = $x->right;

        // 向右旋转过程
        $x->right = $y;
        $y->left = $T3;

        // 更新height
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    // 对节点y进行向左旋转操作，返回旋转后新的根节点x
    //  T1 < y < T2 < x < T3 < y < T4
    //    y                             x
    //  /  \                          /   \
    // T1   x      向左旋转 (y)       y     z
    //     / \   - - - - - - - ->   / \   / \
    //   T2  z                     T1 T2 T3 T4
    //      / \
    //     T3 T4
    private function leftRotate(Node $y): Node
    {

        $x = $y->right;
        $T2 = $x->left;

        // 向左旋转过程
        $x->left = $y;
        $y->right = $T2;

        // 更新height
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }


    /**
     *  向二分搜索树中添加新的元素(key, value)
     *
     *  添加元素的时候，才可能会破坏树的平衡性（一共四种情况）
     *  LL 插入的元素在不平衡节点的左侧的左侧
     *  LR 插入的元素在不平衡节点的左侧的右侧
     *  RR 插入的元素在不平衡节点的右侧的右侧
     *  RL 插入的元素在不平衡节点的右侧的左侧
     *
     * @param $key
     * @param $value
     */
    public function add($key, $value): void
    {
        $this->root = $this->addNode($this->root, $key, $value);
    }

    /**
     * 向以node为根的二分搜索树中插入元素(key, value)，返回插入新节点后二分搜索树的根
     *
     * @param Node|null $node
     * @param $key
     * @param $value
     * @return Node
     */
    private function addNode(?Node $node, $key, $value): Node
    {
        if ($node == null) {
            $this->size++;
            return new Node($key, $value);
        }

//        if (bccomp($key, $node->key) == -1) {
//
//            $node->left = $this->addNode($node->left, $key, $value);
//
//        } elseif (bccomp($key, $node->key) == 1) {
//
//            $node->right = $this->addNode($node->right, $key, $value);
//
//        } elseif (bccomp($key, $node->key) == 0) {
//            // 如果key 存在，则更新
//            $node->value = $value;
//        }

        if (strnatcmp($key, $node->key) < 0) {

            $node->left = $this->addNode($node->left, $key, $value);

        } elseif (strnatcmp($key, $node->key) > 0) {

            $node->right = $this->addNode($node->right, $key, $value);

        } elseif (strnatcmp($key, $node->key) == 0) {
            // 如果key 存在，则更新
            $node->value = $value;
        }

        //更新节点高度
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));

        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);

        /** 平衡维护 ↓ H=height, B=Balance **/

        // LL情况 ↓
        //   ⑨ => H=3 , B=2             ⑧
        //  ⑧  => H=2 , B=1     ===>   ⑦ ⑨
        // ⑦   => H=1 , B=0
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) >= 0) {
            return $this->rightRotate($node);
        }

        // RR
        // ⑦            ⑧
        //  ⑧    ===>  ⑦ ⑨
        //   ⑨
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) <= 0) {
            return $this->leftRotate($node);
        }

        // LR (LR => LL => 右旋)
        // ⑧         ⑧           ⑤
        //①     ==> ⑤     ==>  ①  ⑧
        //  ⑤      ①
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) < 0) {
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }

        // RL (RL => RR => 左旋)
        // ⑤         ⑤           ⑦
        //  ⑨     ==> ⑦     ==> ⑤ ⑨
        // ⑦           ⑨
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) > 0) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }

        return $node;
    }

    /**
     * 返回以node为根节点的二分搜索树中，key所在的节点
     *
     * @param Node|null $node
     * @param $key
     * @return null
     */
    private function getNode(?Node $node, $key)
    {
        if ($node == null) {
            return null;
        }

        if ($key == $node->key) {
            return $node;
        } elseif (strnatcmp($key, $node->key) < 0) {
            return $this->getNode($node->left, $key);
        } elseif (strnatcmp($key, $node->key) > 0) {
            return $this->getNode($node->right, $key);
        }

    }

    /**
     * 是否包含节点
     *
     * @param $key
     * @return bool
     */
    public function contains($key): bool
    {
        return $this->getNode($this->root, $key) != null;
    }

    /**
     * 获取节点的值
     *
     * @param $key
     * @return null
     */
    public function get($key)
    {
        $node = $this->getNode($this->root, $key);
        return $node ? $node->value : null;
    }

    /**
     * 更新节点的值
     *
     * @param $key
     * @param $newValue
     */
    public function set($key, $newValue): void
    {
        $node = $this->getNode($this->root, $key);
        if ($node == null) {
            exit("{$key} doesn't exist!");
        }
        $node->value = $newValue;
    }

    /**
     * 返回以node为根的二分搜索树的最小值所在的节点
     *
     * @param $node
     * @return mixed
     */
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

    /**
     * 从二分搜索树中删除键为key的节点
     *
     * @param $key
     * @return null
     */
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
     *  删除掉以node为根的二分搜索树中 key的节点, 返回删除节点后新的二分搜索树的根
     *
     * @param Node|null $node
     * @param $key
     * @return Node|null
     */
    private function removeNode(?Node $node, $key)
    {

        if ($node == null) {
            return null;
        }


        if (strnatcmp($key, $node->key) < 0) {

            $node->left = $this->removeNode($node->left, $key);
            $retNode = $node;

        } elseif (strnatcmp($key, $node->key) > 0) {

            $node->right = $this->removeNode($node->right, $key);
            $retNode = $node;

        } elseif ($key == $node->key) { //相等情况

            // 待删除节点左子树为空的情况
            if ($node->left == null) {

                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                $retNode = $rightNode;

            } elseif ($node->right == null) {

                // 待删除节点右子树为空的情况
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                $retNode = $leftNode;

            } else {

                // 待删除节点左右子树均不为空的情况

                // 找到比待删除节点大的最小节点, 即待删除节点右子树的最小节点
                // 用这个节点顶替待删除节点的位置
                $successor = $this->minimumNode($node->right);

//                $successor->right = $this->removeMinNode($node->right);

                $successor->right = $this->removeNode($node->right, $successor->key);
                $successor->left = $node->left;

                $node->left = $node->right = null;

                $retNode = $successor;

            }

        }


        if ($retNode == null) {
            return null;
        }

        //更新节点高度
        $retNode->height = 1 + max($this->getHeight($retNode->left), $this->getHeight($retNode->right));

        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($retNode);

        /** 平衡维护 **/
        // LL情况 ↓
        if ($balanceFactor > 1 && $this->getBalanceFactor($retNode->left) >= 0) {
            return $this->rightRotate($retNode);
        }

        // RR
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) <= 0) {
            return $this->leftRotate($retNode);
        }

        // LR (LR => LL => 右旋)
        if ($balanceFactor > 1 && $this->getBalanceFactor($retNode->left) < 0) {
            $retNode->left = $this->leftRotate($retNode->left);
            return $this->rightRotate($retNode);
        }

        // RL (RL => RR => 左旋)
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) > 0) {
            $retNode->right = $this->rightRotate($retNode->right);
            return $this->leftRotate($retNode);
        }

        return $retNode;

    }


    /**
     * 测试avl代码
     *
     */
    public function main()
    {

        $file = fopen("pride-and-prejudice.txt", "r") or exit("Unable to open file!");

        $pattern = '/\b[a-zA-Z]+\b/';

        $words = [];

        while (!feof($file)) {

            $str = fgets($file);
            preg_match_all($pattern, $str, $result);

            foreach ($result as $list) {
                foreach ($list as $word) {
                    if (empty($word) === false) {
                        $words[] = $word;
                    }

                }

            }
        }

        fclose($file);

//        echo date('Y-m-d H:i:s');

        foreach ($words as $word) {

            if ($this->contains($word)) {
                $this->set($word, $this->get($word) + 1);
            } else {
                $this->add($word, 1);
            }

        }

        echo "is BST : " . $this->isBST(). PHP_EOL;
        echo "is Balanced : " . $this->isBalanced(). PHP_EOL;

        // 测试删除方法
        foreach ($words as $word) {

           $this->remove($word);

           echo $word.PHP_EOL. PHP_EOL;

           if ($this->isBst() == false || $this->isBalanced() == false) {

               echo "avlTree Code error;";
               die;
           }

            echo $word.PHP_EOL. PHP_EOL;

        }

        echo date('Y-m-d H:i:s');

    }

}