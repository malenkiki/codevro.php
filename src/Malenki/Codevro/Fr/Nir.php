<?php

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
