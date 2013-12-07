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


/**
 * NIR code class.
 *
 * **NIR** code stands for **Numéro d’Inscription au Répertoire** also known as 
 * **Numéro de Sécurité Sociale** and it is unique for each french citizens.
 *
 * @see http://fr.wikipedia.org/wiki/Num%C3%A9ro_de_s%C3%A9curit%C3%A9_sociale_en_France
 * 
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Nir extends Code implements StandardSize
{
    public function __construct($str)
    {
        parent::__construct(preg_replace('/[^0-9AB]/', '', $str));
    }

	/**
     * For Corsica, letters `A` and `B` are in use, so a conversion must be apply to the code:
     *  - replace `A` and `B` letters by digit `0`
     *  - if letter A was used, then substract the code by 1,000,000
     *  - if letter B was used, then substract the code by 2,000,000
	 * 
	 * @param string $str
     * @return string
	 */
    private static function adapt($str)
    {
		$substract = 0;
		
		if(preg_match('/[Aa]/', $str)){
			$substract = 1000000;
		}
		elseif(preg_match('/[Bb]/', $str)){
			$substract = 2000000;
		}
		
		$int = preg_replace('/[AaBb]/', '0', $str);
		
		return bcsub($int, $substract);
	}
	


    /**
     * Checks NIR validity.
     *
     * @throws \RuntimeException If BC Math PHP module is not available.
     * @return boolean
     */
    public function check()
    {
        if(!extension_loaded('bcmath'))
        {
            throw new \RuntimeException('You must have `bcmath` module installed in order to use ' . __CLASS__);
        }

		$key = substr($this->str_value, 13, 2);
        $str = self::adapt(substr($this->str_value, 0, 13));

	    return ($key == bcsub(97, bcmod($str, 97)));
	}



    /**
     * Checks NIR code length.
     *
     * NIR code must have 15 digits.
     * 
     * @access public
     * @return boolean
     */
    public function checkSize()
    {
        return $this->getLength() == 15;
    }
}
