<?php

namespace Malenki\Codevro;

use Exception;

require_once('Code.php');
class Luhn extends Code
{
	public function modulo10()
	{
        $arr_out = array();
        $str_code = strrev($this->str_value);
	    
	    for($i = 0; $i < $this->int_length; $i++)
	    {
	    	$int_digit = (integer) $str_code[$i];
	    
            // Rang pair
		    if(($i + 1) % 2 == 0)
            {
			    $int_digit = $int_digit * 2;
			    
                $arr_out[] = ($int_digit > 9) ? $int_digit - 9 : $int_digit;
		    }
            // Rang impair
		    else
		    {
		    	$arr_out[] = $int_digit;
		    }
	    }
	    
	    return array_sum($arr_out) % 10;
    }



    public function check()
    {
	    return ! (boolean) $this->modulo10();
    }



    public static function computeCheckDigit($str)
    {
        $n = new self($str . '0');

        $int_mod = $n->modulo10();

        if($int_mod > 0)
        {
            return 10 - $int_mod;
        }
        
        return $int_mod;
    }
}
