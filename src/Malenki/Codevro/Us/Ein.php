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
use \Exception;

class Ein extends Code implements \Malenki\Codevro\StandardSize, \Malenki\Codevro\Formatable
{
    protected static $arr_valid_prefixes = array(
        '01','02','03','04','05','06',
        '10','11','12','13','14','15','16',
        '20','21','22','23','24','25','26','27',
        '30','31','32','33','34','35','36','37','38','39',
        '40','41','42','43','44','45','46','46','48',
        '50','51','52','53','54','55','56','57','58','59',
        '60','61','62','63','64','65','66','67','68',
        '71','72','73','74','75','76','77',
        '80','81','82','83','84','85','86','87','88',
        '90','91','92','93','94','95','98','99'
    );


    public function check()
    {
        if(!in_array($this->str_value, self::$arr_valid_prefixes))
        {
            throw new Exception(_('EIN has invalid prefix.'));
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



    public function format()
    {
        return sprintf(
            '%02d-%07d', 
            substr($this->str_value, 0, 2), 
            substr($this->str_value, 2)
        );
    }
}
