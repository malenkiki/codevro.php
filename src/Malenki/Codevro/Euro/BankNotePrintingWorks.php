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

use Exception;

/**
 * Exemples :
 * L031C3
 * L030D2
 * L078C3
 * P006C5
 * L031A4
 * L049H3
 */
class BankNotePrintingWorks extends Code implements StandardSize
{
    protected static $arr_columns = array(
        'A' => 1,
        'B' => 2,
        'C' => 3,
        'D' => 4,
        'E' => 5,
        'F' => 6,
        'G' => 7,
        'H' => 8,
        'I' => 9,
        'J' => 10
    );

    protected static $arr_allow_first_letters = array(
        'F', 'T', 'D', 'E', 'L', 'P', 'R', 'N', 'K', 'J', 'G', 'U', 'M', 'H'
    );

    public function getCountry()
    {
        // TODO utiliser un code ISO en lieu et place de nom de pays
        $arr_countries = array(
            'F' =>	_('Austria'),
            'T' =>	_('Belgium'),
            'D' =>	_('Finland'),
            'E' =>	_('France'),
            'L' =>	_('France'),
            'P' =>	_('Germany'),
            'R' =>	_('Germany'),
            'N' =>	_('Greece'),
            'K' =>	_('Ireland'),
            'J' =>	_('Italy'),
            'G' =>	_('Netherlands'),
            'H' =>	_('United Kingdom'),
            'U' =>	_('Portugal'),
            'M' =>	_('Spain'),
        );

        return $arr_countries[$this->str_value[0]];
    }

    public function getPrintingFacility()
    {
        // TODO les noms n’ont pas à être traduits
        $arr_printers = array(
            'F' => _('Osterreichische Banknoten und Sicherheitsdruck GmbH'),
            'T' => _('Banque Nationale de Belgique'),
            'D' => _('Setec Oy'),
            'E' => _('Francois Charles Oberthur Fiduciaire'),
            'L' => _('Banque de France'),
            'P' => _('Giesecke & Devrient'),
            'R' => _('Bundesdruckerei'),
            'N' => _('Bank of Greece'),
            'K' => _('Central Bank of Ireland'),
            'J' => _('Banca d’Italia'),
            'G' => _('Johan Enschede en Zonen'),
            'H' => _('De La Rue'),
            'U' => _('Valora'),
            'M' => _('Fabrica Nacional de Moneda y Timbre')
        );

        return $arr_printers[$this->str_value[0]];
    }

    public function getPrintingPlate()
    {
        return (integer) substr($this->str_value, 1, 3);
    }

    public function getRow()
    {
        return (integer) $this->str_value[5];
    }

    public function getColumn()
    {
        return (integer) self::$arr_columns[$this->str_value[4]];
    }

    public function check()
    {
        if (!in_array($this->str_value[0], self::$arr_allow_first_letters)) {
            throw new Exception(_('Printing facility letter is not valid.'));
        } elseif (!preg_match('/^[0-9]{3}$/', substr($this->str_value, 1, 3))) {
            throw new Exception(_('The printing plate part must contain only 3 digits.'));
        } elseif (!in_array($this->str_value[4], array_keys(self::$arr_columns))) {
            throw new Exception(_('The column must be a valid letter.'));
        } elseif (!preg_match('/[0-9]/', $this->str_value[5])) {
            throw new Exception(_('The row must be a digit.'));
        } else {
            return true;
        }
    }

    public function checkSize()
    {
        return $this->getLength() == 6;
    }

}
