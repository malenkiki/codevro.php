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
 * Exemples de test :
 * U23762095871 5€
 * X16557652919 50€
 * U49808780024 20€
 * U14790523136 5€
 *
 * U56461294373 10€
 * U31843475132 5€
 */

class BankNoteSerialNumber extends Code implements StandardSize
{
    protected static $arr_checksum = array(
        'Z' => 9, 
        'Y' => 1,
        'X' => 2,
        'W' => 3,
        'V' => 4,
        'U' => 5,
        'T' => 6,
        'S' => 7,
        'R' => 8,
        'P' => 1,
        'N' => 3,
        'M' => 4,
        'L' => 5,
        'K' => 6,
        'J' => 7,
        'H' => 9,
        'G' => 1,
        'F' => 2,
        'E' => 3,
        'D' => 4
    );
        
    protected $str_national_identification_name = null;


    public function __construct($str)
    {
        if(is_string($str) && strlen(trim($str)))
        {
            $str = trim($str);
            parent::__construct($str);
        }
        else
        {
            throw new \InvalidArgumentException('Euro Bank Note serial number must be a not null string.');
        }
    }


    public function getNationalIdentificationCode()
    {
        if(array_key_exists($this->str_value[0], self::$arr_checksum))
        {
            return $this->str_value[0];
        }
        else
        {
            throw new \Exception('The first letter is not allowed into serial number.');
        }
    }



    public function isSecondSeries()
    {
        return (boolean) preg_match('/A-Z/', $this->str_value{1});
    }



    /**
     * @todo Use ISO code instead of english name 
     * 
     * @access public
     * @return void
     */
    public function getNationalIdentificationName()
    {
        if(is_null($this->str_national_identification_name))
        {
            $arr_checksum = array(
                'Z' => 'Belgium',
                'Y' => 'Greece',
                'X' => 'Germany',
                'W' => 'Denmark',
                'V' => 'Spain',
                'U' => 'France',
                'T' => 'Ireland',
                'S' => 'Italy',
                'R' => 'Luxembourg',
                'P' => 'Netherlands',
                'N' => 'Austria',
                'M' => 'Portugal',
                'L' => 'Finland',
                'K' => 'Sweden',
                'J' => 'United Kingdom',
                'H' => 'Slovenia',
                'G' => 'Cyprus',
                'F' => 'Malta',
                'E' => 'Slovakia',
                'D' => 'Estonia'
            );

            if($this->isSecondSeries())
            {
                $arr_checksum['W'] = 'Germany';
                $arr_checksum['R'] = 'Germany';
                unset($arr_checksum['L']);
                unset($arr_checksum['K']);
                $arr_checksum['H'] = 'United Kingdom';
                unset($arr_checksum['G']);
                unset($arr_checksum['F']);
                $arr_checksum['E'] = 'France';
                $arr_checksum['D'] = 'Poland';
            }

            $this->str_national_identification_name = $arr_checksum[$this->str_value[0]];
        }

        return $this->str_national_identification_name;
    }



    public function check()
    {
        $str = preg_replace('/[A-Z]/', '', $this->str_value);

        if(preg_match('/[A-Z]/', $this->str_value[1]))
        {
            $str .= ord($this->str_value[1]);
        }

        $int = array_sum(str_split($str));

        while($int > 9)
        {
            $str_int = (string) $int;
            $int = array_sum(str_split($str_int));
        }

        if(!isset(self::$arr_checksum[$this->str_value[0]]))
        {
            return false;
        }

        return self::$arr_checksum[$this->str_value[0]] == $int;
    }



    public function checkSize()
    {
        return $this->getLength() == 12;
    }
}

