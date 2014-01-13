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



class BankNoteSerialNumberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanciateKO()
    {
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('');
    }



    public function testCheck1stSeriesOK()
    {
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('U23762095871');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('X16557652919');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('U49808780024');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('U14790523136');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('U56461294373');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('U31843475132');
        $this->assertTrue($s->check());
    }
        
    public function testCheck1stSeriesKO()
    {
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('u23762095871');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('x16557652919');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('u49808780024');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('u14790523136');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('u56461294373');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('u31843475132');
        $this->assertFalse($s->check());
    }


    public function testCheck2ndSeriesOK()
    {
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('ZB0513298374');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('VA0436214792');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('UB1016471792');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('UE2134352573');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('UA1103077083');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('UB8102860643');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('UE7053249824');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('NA3802962421');
        $this->assertTrue($s->check());
    }


    public function testCheck2ndSeriesKO()
    {

        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('zb0513298374');
        $this->assertFalse($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('va0436214792');
        $this->assertFalse($s->check());
        
        $s = new Malenki\Codevro\Euro\BankNoteSerialNumber('ub1016471792');
        $this->assertFalse($s->check());
    }
}
