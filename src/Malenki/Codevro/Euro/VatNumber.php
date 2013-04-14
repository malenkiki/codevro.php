<?php

namespace Malenki\Codevro\Euro;

use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;


class VatNumber extends Code
{
    private function checkAt()
    {
        return preg_match('/^ATU[0-9]{8}$/', $this->str_value);
    }

    private function checkBe()
    {
        return preg_match('/^BE[0-9]{9,10}$/', $this->str_value);
    }

    private function checkBg()
    {
        return preg_match('/^BG[0-9]{9,10}$/', $this->str_value);
    }

    private function checkCy()
    {
        return preg_match('/^CY[0-9]{8}[A-Z]{1}$/', $this->str_value);
    }

    private function checkDk()
    {
        return preg_match('/^DK[0-9]{8}$/', $this->str_value);
    }

    private function checkEe()
    {
        return preg_match('/^EE[0-9]{9}$/', $this->str_value);
    }

    private function checkEs()
    {
        return preg_match('/^ES[A-Z]{1}[0-9]{7}[A-Z]{1}$/', $this->str_value);
    }

    private function checkFi()
    {
        return preg_match('/^FI[0-9]{8}$/', $this->str_value);
    }

    private function checkFr()
    {
        return preg_match('/^FR[A-Z0-9]{2}[0-9]{9}$/', $this->str_value);
    }


    private function checkDe()
    {
        return preg_match('/^DE[0-9]{9}$/', $this->str_value);
    }






    public function check()
    {
        if(!preg_match('/^[A-Z]{2}/', $this->str_value))
        {
            throw new Exception(_('Invalid country code.'));
        }
        else
        {
            return true;
        }
    }
}
