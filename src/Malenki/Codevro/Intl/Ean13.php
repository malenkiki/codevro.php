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

use Malenki\Codevro\StandardSize;

class Ean13 extends Ean implements StandardSize
{
    public function checkSize()
    {
        return $this->getLength() == 13;
    }

    protected function getPrefix()
    {
        return substr($this->str_value, 0, 3);
    }

    //TODO : http://fr.wikipedia.org/wiki/Code-barres_EAN
    public function isInternalUse()
    {
    }

    //TODO : http://fr.wikipedia.org/wiki/Code-barres_EAN
    public function getCountry()
    {
    }

    public function isIsbn()
    {
        return in_array($this->getPrefix(), array('978', '979'));
    }

    public function isIssn()
    {
        return $this->getPrefix() == '977';
    }
}
