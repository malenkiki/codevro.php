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

namespace Malenki\Codevro\Fr;

class Rib
extends \Malenki\Codevro\Code
implements \Malenki\Codevro\StandardSize, \Malenki\Codevro\Formatable
{
    public function check()
    {
        $str_account = '';
        $arr_account = str_split($this->getNumeroDeCompte());

        foreach($arr_account as $str_c)
        {
            if(!is_numeric($str_c))
            {
                $int_c_prov = ord($str_c) - 64;

                $int_c = (($int_c_prov + pow(2, ($int_c_prov - 10) / 9 )) % 10);
                $int_c += (($int_c_prov > 18 && $int_c_prov < 25) ? 1 : 0);

                $str_c = (string) $int_c;
            }

            $str_account .= $str_c;
        }

        $str_rib  = $this->getCodeBanque();
        $str_rib .= $this->getCodeGuichet();
        $str_rib .= $str_account;
        $str_rib .= $this->getCleRib();

        return bcmod($str_rib, 97) == 0;
    }



    public function checkSize()
    {
        return $this->getLength() == 23;
    }



    public function format()
    {
        return sprintf(
            '%05d %05d %011d %02d',
            $this->getCodeBanque(),
            $this->getCodeGuichet(),
            $this->getNumeroDeCompte(),
            $this->getCleRib()
        );
    }



    public function getCodeBanque()
    {
        return substr($this->str_value,0 , 5);
    }



    public function getCodeGuichet()
    {
        return substr($this->str_value, 5, 5);
    }



    public function getNumeroDeCompte()
    {
        return substr($this->str_value, 10, 11);
    }



    public function getCleRib()
    {
        return substr($this->str_value,21,2);
    }
}
