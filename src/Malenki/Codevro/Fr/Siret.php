<?php

namespace Malenki\Codevro\Fr;
use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;
use Malenki\Codevro\Luhn;

/**
 *
 * Exemple de test: 49359757900025
 */
class Siret extends Luhn implements StandardSize
{
    public function checkSize()
    {
        return $this->getLength() == 14;
    }
}

