<?php

namespace Malenki\Codevro\Fr;
use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;
use Malenki\Codevro\Luhn;



/**
 * Siren 
 * 
 * Exemple de test: 493597579, 732829320
 */
class Siren extends Luhn implements StandardSize
{
    public function checkSize()
    {
        return $this->getLength() == 9;
    }
}

