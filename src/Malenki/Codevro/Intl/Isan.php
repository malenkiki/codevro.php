<?php
/*
Copyright (c) 2014 Michel Petit <petit.michel@gmail.com>

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
use \Malenki\Codevro\Code;
use \Malenki\Codevro\Formatable;
use \Malenki\Codevro\StandardSize;

class Isan extends Code implements Formatable, StandardSize
{
    public static function computeCheckDigit($str)
    {
        $int_s = 0;
        $int_as = 0;
        $int_p = 0;
        $int_ap = 0;

        $int_mod_one = 37;
        $int_mod_two = $int_mod_one - 1;

        $arr = str_split(strtolower(substr($str, 0, 16)));

        foreach($arr as $i => $c)
        {
            $int_s = is_numeric($c) ? (int) $c : ord($c) - 87;

            $int_s += ($i > 0) ? $int_ap : $int_mod_two;
            
            $int_as = $int_s;

            if($int_s > $int_mod_two)
            {
                $int_as -= $int_mod_two;
            }

            if($int_as == 0)
            {
                $int_as = $int_mod_two;
            }

            $int_p = 2 * $int_as;

            $int_ap = $int_p;

            if($int_p >= $int_mod_one)
            {
                $int_ap -= $int_mod_one;
            }
        }
            
        if($int_ap == 1)
        {
            return (string) 0;
        }

        $int_sub = $int_mod_one - $int_ap;

        if($int_sub < 10)
        {
            return (string) $int_sub;
        }
        else
        {
            return chr($int_sub + 55);
        }
    }




    public function getRoot()
    {
        return substr($this->str_value, 0, 12);
    }


    public function getEpisode()
    {
        return substr($this->str_value, 12, 4);
    }


    public function format()
    {
        return sprintf(
            'ISAN %s',
            strtoupper(
                implode(
                    '-',
                    str_split($this->str_value, 4)
                )
            )
        );
    }


    public function check()
    {
        return (array_pop(str_split($this->str_value)) == self::computeCheckDigit($this->str_value)) && $this->checkSize();
    }



    public function checkSize()
    {
        return $this->getLength() == 17;
    }


    public function __toString()
    {
        return $this->format();
    }
}
