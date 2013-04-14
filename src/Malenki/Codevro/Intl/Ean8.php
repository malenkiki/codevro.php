<?php

namespace Malenki\Codevro\Intl;

use Malenki\Codevro\StandardSize;
use Malenki\Codevro\Formatable;

class Ean8 extends Ean implements StandardSize, Formatable
{
    public function checkSize()
    {
        return $this->getLength() == 8;
    }

    public function format()
    {
        return sprintf(
            '%s-%s', 
            substr($this->str_value, 0, 4),
            substr($this->str_value, 4)
        );
    }
}

