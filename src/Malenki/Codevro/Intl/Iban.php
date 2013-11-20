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
