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
use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;
use Malenki\Codevro\Luhn;



/**
 * Siren french code identifies enterprises.
 *
 * It is composed of 9 digits, sometimes grouped by 3, and it is checkable 
 * using the Luhn algorithm.
 * 
 * Examples: 493597579, 732829320, 493 597 579, 732 829 320 are OK
 *
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Siren extends Luhn implements StandardSize
{
    public function __construct($str)
    {
        parent::__construct(preg_replace('/[^0-9]/', '', $str));
    }


    public function checkSize()
    {
        return $this->getLength() == 9;
    }
}

