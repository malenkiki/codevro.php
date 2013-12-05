<?php
/*
Copyright (c) 2013 Michel Petit <petit.michel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Malenki\Codevro;

use Exception;

/**
 * Luhn algorithm definition.
 *
 * Luhn algorithm is used into many code checking. This is the base algorithm. 
 * 
 * @see http://en.wikipedia.org/wiki/Luhn_algorithm
 * @uses Code
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
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



    /**
     * Check whether the code follows Luhn algorithm or not.
     * 
     * @access public
     * @return boolean
     */
    public function check()
    {
	    return ! (boolean) $this->modulo10();
    }



    /**
     * Computes the check digit for the given string.
     * 
     * This creates a check digit for a string.
     *
     * @param string $str 
     * @static
     * @access public
     * @return integer
     */
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
