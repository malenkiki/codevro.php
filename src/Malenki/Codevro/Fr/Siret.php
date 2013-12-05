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
 * Siret is the extended version of french Siren code.
 *
 * Like Siren, it is an unique enterprise identifier, its first nine digits are 
 * the same as the Siren, the others are location/building identifier.
 * 
 * Additional digits to the Siren code are like this: `000XK` where `X` starts 
 * to one for the first building, then it is two for the second and so on. The 
 * `K` is the check digit.
 *
 * This code can be formated without spaces or by using 3 groups of 3 digits and 
 * one group of 5 digits.
 *
 * Example: 49359757900025 and 493 597 579 00025 are OK. 
 * 
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Siret extends Luhn implements StandardSize
{
    public function checkSize()
    {
        return $this->getLength() == 14;
    }



    public function getSiren()
    {
        if($this->check())
        {
            return new Siren(substr($this->getValue(), 0, 9));
        }
        else
        {
            throw new \RuntimeException('Cannont get Siren part form Siret: Siret is not valid!');
        }
    }
}

