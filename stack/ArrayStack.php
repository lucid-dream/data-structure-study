<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/4
 * Time: 下午11:10
 */
include 'ArrayList.php';
include 'Stack.php';

class ArrayStack implements Stack
{

    private $array;

    public function __construct($capacity = 10)
    {
        $this->array = new ArrayList($capacity);
    }

    public function getSize()
    {
    return $this->array->getSize();
    }

    public function isEmpty()
    {
        return $this->array->isEmpty();
    }

    public function getCapacity()
    {
        return $this->array->getCapacity();
    }

    public function push($e)
    {
        $this->array->addLast($e);
    }

    public function pop()
    {
        return $this->array->removeLast();
    }

    public function peek()
    {
        return $this->array->getLast();
    }

}

try {
    $arrayStack = new ArrayStack();
    $arrayStack->push(1);
    $arrayStack->push(2);
    $arrayStack->push(3);

    var_dump($arrayStack->peek());
    var_dump($arrayStack->pop());
    var_dump($arrayStack);

} catch (Exception $exception) {

    echo $exception->getMessage();

}
