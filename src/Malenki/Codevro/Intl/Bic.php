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

class Bic extends \Malenki\Codevro\Code
{
    public function check()
    {
        if($this->getLength() != 8 && $this->getLength() != 11)
        {
            throw new Exception(_('Bad BIC’s size. Must have 8 or 11 characters.'));
        }

        if(!preg_match('/^[A-Z]{4}$/', $this->getInstitutionCode()))
        {
            throw new Exception(_('Institution Code inside BIC must have only 4 latters.'));
        }

        if(!preg_match('/^[A-Z]{2}$/', $this->getCountryCode()))
        {
            throw new Exception(_('Country Code must have 2 letters.'));
        }

        if(!preg_match('/^[A-Z0-9]{2}$/', $this->getLocationCode()))
        {
            throw new Exception(_('Location Code must have 2 letters or digits.'));
        }

        return true;
    }

    public function isPrimaryOffice()
    {
        return $this->getLength() == 8;
    }



    public function getInstitutionCode()
    {
        return substr($this->str_value, 0, 4);
    }



    public function getCountryCode()
    {
        return substr($this->str_value, 4, 2);
    }



    public function getLocationCode()
    {
        return substr($this->str_value, 6, 2);
    }



    public function getBranchCode()
    {
        return substr($this->str_value, 8);
    }
}
