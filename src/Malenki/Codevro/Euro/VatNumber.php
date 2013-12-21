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

namespace Malenki\Codevro\Euro;

use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;


/**
 * European Vat Identification Number.
 *
 * @see http://en.wikipedia.org/wiki/VAT_identification_number 
 * @see http://www.pruefziffernberechnung.de/U/USt-IdNr.shtml
 * @see http://www.ebsoft.org/mambo/ressources/clefs.htm
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class VatNumber extends Code
{
    public function __construct($str)
    {
        if(is_string($str) && strlen(trim($str)))
        {
            $str = preg_replace('/[^A-Z0-9]/', '', trim($str));
            parent::__construct($str);
        }
        else
        {
            throw new \InvalidArgumentException('European VAT Identification Number must be a not null string.');
        }
    }

    private function checkAt()
    {
        return (boolean) preg_match('/^ATU[0-9]{8}$/', $this->str_value);
    }

    private function checkBe()
    {
        return (boolean) preg_match('/^BE[0-9]{9,10}$/', $this->str_value);
    }

    private function checkBg()
    {
        return (boolean) preg_match('/^BG[0-9]{9,10}$/', $this->str_value);
    }

    private function checkCy()
    {
        return (boolean) preg_match('/^CY[0-9]{8}[A-Z]{1}$/', $this->str_value);
    }

    private function checkDk()
    {
        return (boolean) preg_match('/^DK[0-9]{8}$/', $this->str_value);
    }

    private function checkEe()
    {
        return (boolean) preg_match('/^EE[0-9]{9}$/', $this->str_value);
    }

    private function checkEs()
    {
        return (boolean) preg_match('/^ES[A-Z]{1}[0-9]{7}[A-Z]{1}$/', $this->str_value);
    }

    private function checkFi()
    {
        return (boolean) preg_match('/^FI[0-9]{8}$/', $this->str_value);
    }

    private function checkFr()
    {
        if(extension_loaded('bcmath'))
        {
            if(preg_match('/^FR[0-9]{2}/', $this->str_value))
            {
                $str_siren = substr($this->str_value, 4, 9); 
                $str_key = substr($this->str_value, 2, 2);

                return $str_key == bcmod(bcmod($str_siren, 97) * 3 + 12, 97);
            }
        }
        else
        {
            trigger_error('You have not BCMath PHP extension installed, it is strongly recommanded to have it for checking Franch VAT  with check digit.', E_USER_WARNING);
        }
        
        return (boolean) preg_match('/^FR[A-Z0-9]{2}[0-9]{9}$/', $this->str_value);
    }


    private function checkDe()
    {
        return (boolean) preg_match('/^DE[0-9]{9}$/', $this->str_value);
    }






    public function check()
    {
        if(!preg_match('/^[A-Z]{2}/', $this->str_value))
        {
            throw new \Exception(_('Invalid country code.'));
        }
        else
        {
            $str_country = ucfirst(strtolower(substr($this->str_value, 0, 2)));

            $str_method = 'check' . $str_country;

            if(method_exists($this, $str_method))
            {
                return $this->$str_method();
            }
            else
            {
                trigger_error('This method is not implemented yet', E_USER_WARNING);
            }

            return false;
        }
    }
}
