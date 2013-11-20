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


class Nir extends Code implements StandardSize
{
	/**
	 * Pour le cas de la Corse, les lettres A et B sont utilisées, il faut donc
	 * adapter le nombre.
	 * 
	 * Les lettres A et B sont remplacées par un zéro et on soustrait par
	 * 1 000 000 dans le cas de A et de 2 000 000 dans le cas de B.
	 * 
	 * @param string $str
	 */
	private static function adapt($str){
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
	
	
	public function check(){
		$key = substr($this->str_value, 13, 2);
		$str = self::adapt(substr($this->str_value, 0, 13));
	    return ($key == bcsub(97, bcmod($str, 97)));
	}

    public function checkSize()
    {
        return $this->getLength() == 15;
    }
}
