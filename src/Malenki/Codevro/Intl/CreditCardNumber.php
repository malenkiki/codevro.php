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


class CreditCardNumber
extends \Malenki\Codevro\Luhn
implements \Malenki\Codevro\Formatable
{
    /**
     * Gets Issuer identification number (IIN)
     * 
     * @see http://en.wikipedia.org/wiki/Credit_card_number
     * @access public
     * @return void
     */
    public function getIin()
    {
        return substr($this->getValue(), 0, 6);
    }


    /**
     * Gets Major Industry Identifier (MII) 
     * 
     * @see http://en.wikipedia.org/wiki/Credit_card_number
     * @access public
     * @return void
     */
    public function getMii()
    {
        return substr($this->getValue(), 0, 1);
    }

    /**
     * Formats credit card number by grouping digits by 4 
     * 
     * @access public
     * @return string
     */
    public function format()
    {
        return implode(' ', str_split($this->str_value, 4));
    }
}
