<?php

class struct_pile {
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var struct_pile 
     */
    public $next;
}

class Pile
{
    public $stack;

    private $size;

    public function __construct()
    {
        $this->stack = [];
        $this->size = 0;
    }

    public function push($value) {

        $element = new \struct_pile ();
        $element->value = $value;
        $element->next = $this->stack;

        $this->size++;
        $this->stack = $element;
    }

    public function pop() {
        $tmp = $this->stack;
        $value = null;

        if(!$this->isEmpty()) {
            $value = $tmp->value;
            $this->stack = $tmp->next;
            $this->size--;
        }

        return $value;
    }

    public function first() {
        $value = null;

        if(!$this->isEmpty()) {
            $value = $this->stack->value;
        }

        return $value;
    }

    public function size() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->stack === [];
    }

}
