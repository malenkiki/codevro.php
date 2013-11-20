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
use Malenki\Codevro\Formatable;
use \Exception;

/*
 * TODO: à titre indicatif, indiquer pour les SSN d’avant 2011 le nom de l’État en fonction de l’Area Group
 *
  001-003 NH    400-407 KY    530     NV 
  004-007 ME    408-415 TN    531-539 WA
  008-009 VT    416-424 AL    540-544 OR
  010-034 MA    425-428 MS    545-573 CA
  035-039 RI    429-432 AR    574     AK
  040-049 CT    433-439 LA    575-576 HI
  050-134 NY    440-448 OK    577-579 DC
  135-158 NJ    449-467 TX    580     VI Virgin Islands
  159-211 PA    468-477 MN    581-584 PR Puerto Rico
  212-220 MD    478-485 IA    585     NM
  221-222 DE    486-500 MO    586     PI Pacific Islands*
  223-231 VA    501-502 ND    587-588 MS
  232-236 WV    503-504 SD    589-595 FL
  237-246 NC    505-508 NE    596-599 PR Puerto Rico
  247-251 SC    509-515 KS    600-601 AZ
  252-260 GA    516-517 MT    602-626 CA
  261-267 FL    518-519 ID    627-645 TX
  268-302 OH    520     WY    646-647 UT
  303-317 IN    521-524 CO    648-649 NM
  318-361 IL    525     NM    *Guam, American Samoa, 
  362-386 MI    526-527 AZ     Philippine Islands, 
  387-399 WI    528-529 UT     Northern Mariana Islands

  650-699 unassigned, for future use
  700-728 Railroad workers through 1963, then discontinued
  729-799 unassigned, for future use
  800-999 not valid SSNs.  Some sources have claimed that numbers
          above 900 were used when some state programs were converted
          to federal control, but current SSA documents claim no
          numbers above 799 have ever been used.

 * 
 */
class Ssn extends Code implements StandardSize, Formatable
{
    protected static $arr_only_for_ads = array(
        '987654320',
        '987654321',
        '987654322',
        '987654323',
        '987654324',
        '987654325',
        '987654326',
        '987654327',
        '987654328',
        '987654329'
    );

    protected static $arr_invalids = array(
        '002281852',
        '042103580',
        '062360749',
        '078051120',
        '095073645',
        '128036045',
        '135016629',
        '141186941',
        '165167999',
        '165187999',
        '165207999',
        '165227999',
        '165247999',
        '189092294',
        '212097694',
        '212099999',
        '306302348',
        '308125070',
        '468288779',
        '549241889'
    );



    public function check()
    {
        if($this->getArea() == '000')
        {
            throw new Exception(_('SSN Area part cannot have three times the 0 digit.'));
        }

        elseif($this->getGroup() == '00')
        {
            throw new Exception(_('SSN Group part cannot contain only 0 digits.'));
        }

        elseif($this->getSerial() == '0000')
        {
            throw new Exception(_('SSN Serial part cannot contain the digit 0 four times.'));
        }

        elseif($this->getArea() == '666')
        {
            throw new Exception(_('SSN Area part cannot be 666.'));
        }

        elseif(in_array($this->getValue(), self::$arr_invalids))
        {
            throw new Exception(_('This SSN has invalidated by use in advertising'));
        }
        
        elseif(in_array($this->getValue(), self::$arr_only_for_ads))
        {
            throw new Exception(_('This SSN has to be use only into advertisings, it is not a real SSN.'));
        }
        
        // pas sûr de moi, je dois vérifier mes sources…
        elseif(in_array($this->getArea(), range('900', '999')))
        {
            throw new Exception(_('SSN Area Part connot be into the range 900-999.'));
        }
        else
        {
            return true;
        }
        
    }



    public function checkSize()
    {
        return $this->getLength() == 9;
    }



    public function getArea()
    {
        return substr($this->getValue(), 0, 3);
    }



    public function getGroup()
    {
        return substr($this->getValue(), 3, 2);
    }



    public function getSerial()
    {
        return substr($this->getValue(), 5);
    }

    public function format()
    {
        return sprintf(
            '%03d-%02d-%04d', 
            substr($this->str_value, 0, 3), 
            substr($this->str_value, 3, 2),
            substr($this->str_value, 5)
        );
    }
}
