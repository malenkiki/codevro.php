<?php
/*
Copyright (c) 2014 Michel Petit <petit.michel@gmail.com>

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



/**
 * Some examples: Inception: 0000-0002-B3C8-0000-3-0000-0000-S
 * Stargate Atlantis - Season 1 - Disc 2: 0000-0000-DDB0-0069-Q-0000-0000-X
 * Stargate Atlantis - Season 1 - Disc 3: 0000-0000-DDB0-006A-O-0000-0000-2
 * Stargate Atlantis - Season 1 - Disc 4: 0000-0000-DDB0-006B-M-0000-0000-8
 */
class VisanTest extends PHPUnit_Framework_TestCase
{

    public function testVisanInstanciationShoudBeOk()
    {
        $s = new Malenki\Codevro\Intl\Visan('00000002B3C80000300000000S');
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB00069Q00000000X');
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006AO000000002');
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006BM000000008');
    }


    public function testCheckingGoogVisanMustSuccess()
    {
        $s = new Malenki\Codevro\Intl\Visan('00000002B3C80000300000000S');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB00069Q00000000X');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006AO000000002');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006BM000000008');
        $this->assertTrue($s->check());
    }
    
    
    public function testCheckingBadVisanMustFail()
    {
        $s = new Malenki\Codevro\Intl\Visan('00000002B3C80000300000000X');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB00069Q00000000Y');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006AO000000402');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006BN000000008');
        $this->assertFalse($s->check());
    }


    public function testGettingVersionPartSouldBeRightPart()
    {
        $s = new Malenki\Codevro\Intl\Visan('00000002B3C80000300000000S');
        $this->assertEquals('00000000', $s->getVersion());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB00069Q00000000X');
        $this->assertEquals('00000000', $s->getVersion());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006AO000000002');
        $this->assertEquals('00000000', $s->getVersion());
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006BM000000008');
        $this->assertEquals('00000000', $s->getVersion());
    }
    

    public function testFormatedVisanShouldBeWellFormated()
    {
        $s = new Malenki\Codevro\Intl\Visan('00000002B3C80000300000000S');
        $this->assertEquals('ISAN 0000-0002-B3C8-0000-3-0000-0000-S', $s->format());
        $this->assertEquals('ISAN 0000-0002-B3C8-0000-3-0000-0000-S', "$s");
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB00069Q00000000X');
        $this->assertEquals('ISAN 0000-0000-DDB0-0069-Q-0000-0000-X', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-0069-Q-0000-0000-X', "$s");
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006AO000000002');
        $this->assertEquals('ISAN 0000-0000-DDB0-006A-O-0000-0000-2', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-006A-O-0000-0000-2', "$s");
        $s = new Malenki\Codevro\Intl\Visan('00000000DDB0006BM000000008');
        $this->assertEquals('ISAN 0000-0000-DDB0-006B-M-0000-0000-8', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-006B-M-0000-0000-8', "$s");
    }
}

