<?php

namespace Malenki\Codevro\Intl;

use Exception;

class Isbn10
extends \Malenki\Codevro\Code
implements \Malenki\Codevro\StandardSize
{
    public function check()
    {
        if(!preg_match('/^[0-9]{9}/', $this->str_value))
        {
            throw new Exception(_('The first nine characters must be digits.'));
        }

        if(!preg_match('/[0-9X]$/', $this->str_value))
        {
            throw new Exception(_('The check digit must be digit from 0 to 9 or the letter X.'));
        }

        $arr = str_split($this->str_value);
        $int_sum = 0;

        foreach($arr as $k => $v)
        {
            if($v == 'X')
            {
                $v = 10;
            }
            
            $int_sum += (10 - $k) * $v;
        }

        return ($int_sum % 11) == 0;
    }



    public function checkSize()
    {
        return $this->getLength() == 10;
    }



    public function getCheckDigit()
    {
        return $this->str_value[9];
    }
}

