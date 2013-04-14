<?php

namespace Malenki\Codevro;

abstract class Code
{
    protected $str_value = null;
    protected $int_length = 0;


    public function __construct($str)
    {
        $this->str_value = (string) $str;
        $this->int_length = strlen($str);
    }



    public function getValue()
    {
        return $this->str_value;
    }

    public function getLength()
    {
        return $this->int_length;
    }


    abstract public function check();

    public function __toString()
    {
        return $this->str_value;
    }
}
