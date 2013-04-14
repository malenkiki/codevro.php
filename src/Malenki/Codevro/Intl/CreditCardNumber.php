<?php
namespace Malenki\Codevro\Intl;


class CreditCardNumber
extends \Malenki\Codevro\Luhn
implements \Malenki\Codevro\Formatable
{
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
