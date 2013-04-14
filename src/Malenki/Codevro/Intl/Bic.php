<?php

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
