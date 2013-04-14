<?php
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


    public function getNationalIdentificationCode()
    {
        if(array_key_exists($this->str_value[0], self::$arr_checksum))
        {
            return $this->str_value[0];
        }
        else
        {
            throw new \Exception(_('The first letter is not allowed into serial number.'));
        }
    }


    public function getNationalIdentificationName()
    {
        if(is_null($this->str_national_identification_name))
        {
            $arr_checksum = array(
                'Z' => _('Belgium'),
                'Y' => _('Greece'),
                'X' => _('Germany'),
                'W' => _('Denmark'),
                'V' => _('Spain'),
                'U' => _('France'),
                'T' => _('Ireland'),
                'S' => _('Italy'),
                'R' => _('Luxembourg'),
                'P' => _('Netherlands'),
                'N' => _('Austria'),
                'M' => _('Portugal'),
                'L' => _('Finland'),
                'K' => _('Sweden'),
                'J' => _('United Kingdom'),
                'H' => _('Slovenia'),
                'G' => _('Cyprus'),
                'F' => _('Malta'),
                'E' => _('Slovakia'),
                'D' => _('Estonia')
            );

            $this->str_national_identification_name = $arr_checksum[
                $this->getNationalIdentificationCode()
                ];
        }

        return $this->str_national_identification_name;
    }



    public function check()
    {
        $str = preg_replace('/[A-Z]/', '', $this->str_value);

        $int = array_sum(str_split($str));

        while($int > 9)
        {
            $str_int = (string) $int;
            $int = array_sum(str_split($str_int));
        }

        return self::$arr_checksum[$this->getNationalIdentificationCode()] == $int;
    }



    public function checkSize()
    {
        return $this->getLength() == 12;
    }
}

