<?php

namespace Malenki\Codevro\Intl;

use Malenki\Codevro\StandardSize;

class Ean13 extends Ean implements StandardSize
{
    public function checkSize()
    {
        return $this->getLength() == 13;
    }

    protected function getPrefix()
    {
        return substr($this->str_value, 0, 3);
    }

    //TODO : http://fr.wikipedia.org/wiki/Code-barres_EAN
    public function isInternalUse()
    {
    }

    //TODO : http://fr.wikipedia.org/wiki/Code-barres_EAN
    public function getCountry()
    {
    }

    public function isIsbn()
    {
        return in_array($this->getPrefix(), array('978', '979'));
    }

    public function isIssn()
    {
        return $this->getPrefix() == '977';
    }
}
