<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/6
 * Time: 下午5:56
 */

/***

使用栈实现：
给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。

    有效字符串需满足：

        左括号必须用相同类型的右括号闭合。
        左括号必须以正确的顺序闭合。
        注意空字符串可被认为是有效字符串。

    示例 1:
        输入: "()"
        输出: true

    示例 2:
        输入: "()[]{}"
        输出: true

    示例 3:
        输入: "(]"
        输出: false

    示例 4:
        输入: "([)]"
        输出: false
 *
    示例 5:
        输入: "{[]}"
        输出: true
 *
 */

class Solution
{

    public function isValid($str) {

        $stack = new SplStack();

        for ($i=0; $i < strlen($str); $i++) {

            $char = $str[$i];

            if (in_array($char, ['(', '[', '{'])) {

                $stack->push($char);

            } else {

                if ($stack->isEmpty()) {
                    return false;
                }

                $topChar = $stack->pop();

                if($char == ')' && $topChar != '(') {

                    return false;

                }

                if($char == ']' && $topChar != '[') {

                    return false;

                }

                if($char == '}' && $topChar != '{') {

                    return false;

                }

            }



        }

        return $stack->isEmpty();

    }

}

$solution = new Solution();

$result = $solution->isValid("[]");
var_dump($result);

$result = $solution->isValid("()[]{}");
var_dump($result);

$result = $solution->isValid("(]");
var_dump($result);

$result = $solution->isValid("([)]");
var_dump($result);

$result = $solution->isValid("{[]}");
var_dump($result);


