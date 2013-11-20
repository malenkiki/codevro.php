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
