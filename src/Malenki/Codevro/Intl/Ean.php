<?php


namespace Malenki\Codevro\Intl;

use Malenki\Codevro\Code;

class Ean extends Code 
{
    public function check()
    {
        $int_key = (integer) $this->str_value[strlen($this->str_value) - 1];
        $arr_str = str_split(substr(strrev($this->str_value), 1));

        $int_sum_weights = 0;
        $int_sum_no_weights = 0;

        // Carefull! position starts from 0 not from 1, so even, odd are inverted here.
        foreach($arr_str as $k => $v)
        {
            if($k % 2)
            {
                $int_sum_no_weights += $v;
            }
            else
            {
                $int_sum_weights += $v;
            }
        }

        $int_calculated_key = 10 - (($int_sum_no_weights + 3 * $int_sum_weights) % 10);

        if($int_calculated_key == 10)
        {
            $int_calculated_key = 0;
        }

        return $int_key == $int_calculated_key;
    }
}
