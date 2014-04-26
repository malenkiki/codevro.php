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
namespace Malenki\Codevro\Us;
use Malenki\Codevro\Code;
use Malenki\Codevro\StandardSize;
use \Exception;

/**
 * USBill
 *
 *
 * The first letter of the prefix denotes the currency series.
 * The second letter of the prefix indicates the Federal Reserve Bank at which the bill was produced.
 * The eight digits represent the bill's sequential order within its group. The one-letter suffix is a further sequential counter within each Reserve Bank's bills in a series.
 * The suffix letter advances when the 8-digit number reaches 99999999 (for example, xx99999999B is followed by xx00000001C). The entire alphabet is used for this process except for the letter O.
 * Bills with a star in the place of their suffix letter are replacements for bills that did not meet federal standards after the printing process and are subsequently destroyed.
 *
 * U.S. Federal Reserve Bank Letter & Number Codes City
 *            Number  Letter
 * Boston         1   A
 * Chicago        7   G
 * New York       2   B
 * St. Louis      8   H
 * Philadelphia   3   C
 * Minneapolis    9   I
 * Cleveland      4   D
 * Kansas City    10  J
 * Richmond       5   E
 * Dallas         11  K
 * Atlanta        6   F
 * San Francisco  12  L
 *
 * See http://www.ischool.utexas.edu/~jpwms/mixednumbers/money.html
 */
class BankNoteSerialNumber extends Code implements StandardSize
{
    protected $currency_series = null;
    protected $federal_reserve_bank_code = null;
    protected $federal_reserve_bank_name = null;
    protected $sequential_number = null;
    protected $sequence_code = null;

    public function check()
    {
        if (!preg_match('/[AGBHCIDJEKFL]/', $this->str_value[1])) {
            throw new Exception(_('Invalid Federal Reserve Bank Code.'));
        }

        if ($this->getSequenceCode() == 'O') {
            throw new Exception(_('Invalid Sequence Code.'));
        }

        return (boolean) preg_match(
            '/^[A-Z][AGBHCIDJEKFL][0-9]{8}[ABCDEFGHIJKLMNPQRSTUVWXYZ]$/',
            $this->str_value
        );
    }

    public function checkSize()
    {
        return $this->getLength() == 11;
    }

    public function getCurrencySeries()
    {
        if (is_null($this->currency_series)) {
            $this->currency_series = $this->str_value[0];
        }

        return $this->currency_series;
    }

    public function getFederalReserveBankCode()
    {
        if (is_null($this->federal_reserve_bank_code)) {
            $this->federal_reserve_bank_code = $this->str_value[1];
        }

        return $this->federal_reserve_bank_code;
    }

    public function getFederalReserveBankName()
    {
        if (is_null($this->federal_reserve_bank_code)) {
            $arr_frbcl = array(
                'A' => _('Boston'),
                'B' => _('New York'),
                'C' => _('Philadelphia'),
                'D' => _('Cleveland'),
                'E' => _('Richmond'),
                'F' => _('Atlanta'),
                'G' => _('Chicago'),
                'H' => _('Saint Louis'),
                'I' => _('Minneapolis'),
                'J' => _('Kansas City'),
                'K' => _('Dallas'),
                'L' => _('San Francisco'),
            );
            $this->federal_reserve_bank_name = $arr_frbcl[$this->getFederalReserveBankCode()];
        }

        return $this->federal_reserve_bank_name;
    }

    public function getSequentialNumber()
    {
        if (is_null($this->sequential_number)) {
            $this->sequential_number = substr($this->str_value, 2, 8);
        }

        return $this->sequential_number;
    }

    public function getSequenceCode()
    {
        if (is_null($this->sequence_code)) {
            $this->sequence_code = $this->value[strlen($this->str_value) - 1];
        }

        return $this->sequence_code;
    }
}
