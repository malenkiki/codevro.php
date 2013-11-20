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
