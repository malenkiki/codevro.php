<?php

namespace Malenki\Codevro\Intl;

class Iban
extends \Malenki\Codevro\Code
implements \Malenki\Codevro\Formatable
{
    public function check()
    {
        $arr_str = str_split(substr($this->str_value,4) . substr($this->str_value,0,4));
        $str = '';

        foreach($arr_str as $c)
        {
            if(preg_match('/[A-Z]/', $c))
            {
                $str .= ord($c) - 55;
            }
            else
            {
                $str .= $c;
            }
        }

        return ((integer) bcmod($str, 97)) == 1;
    }


    public function getCountry()
    {
    }

    public function getCountryCode()
    {
        return substr($this->str_value, 0, 2);
    }

    public function getKey()
    {
        return substr($this->str_value, 2, 2);
    }

    public function format()
    {
        $str = '';
        $arr = str_split($this->str_value);

        foreach($arr as $k => $v)
        {
            $k++;
            $str .= $v;

            if($k % 4 == 0)
            {
                $str .= ' ';
            }
        }

        return trim($str);
    }
}
