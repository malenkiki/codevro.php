<?php

namespace Malenki\Codevro\Intl;

use Exception;

class Issn
extends \Malenki\Codevro\Code
implements \Malenki\Codevro\Formatable, \Malenki\Codevro\StandardSize
{
    public function check()
    {
        if(!preg_match('/^[0-9]{7}/', $this->str_value))
        {
            throw new Exception(_('The first seven characters must be digit.'));
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
            
            $int_sum += (8 - $k) * $v;
        }

        return ($int_sum % 11) == 0;
    }



    public function format()
    {
        return sprintf(
            'ISSN %04d-%04d',
            substr($this->str_value, 0, 4),
            substr($this->str_value, 4)
        );
    }



    public function checkSize()
    {
        return $this->getLength() == 8;
    }



    public function getCheckDigit()
    {
        return $this->str_value[7];
    }
}
