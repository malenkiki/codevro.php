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



class SiretTest extends PHPUnit_Framework_TestCase
{

    public function testCheckOK()
    {
        $s = new Malenki\Codevro\Fr\Siret('49359757900025');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('47862460400029');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('493 597 579 00025');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('478 624 604 00029');
        $this->assertTrue($s->check());
    }
    
    
    
    public function testCheckKO()
    {
        $s = new Malenki\Codevro\Fr\Siret('49359757900026');
        $this->assertFalse($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('4786246040002');
        $this->assertFalse($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('493 597 579 00026');
        $this->assertFalse($s->check());
        
        $s = new Malenki\Codevro\Fr\Siret('478 624 604 0002');
        $this->assertFalse($s->check());
    }
    
    
    public function testExtractSirenOK()
    {
        $siret = new Malenki\Codevro\Fr\Siret('49359757900025');

        $this->assertEquals('Malenki\Codevro\Fr\Siren', get_class($siret->getSiren()));
        $this->assertEquals('493597579', $siret->getSiren()->getValue());
    }


    /**
     * @expectedException RuntimeException
     */
    public function testExtractSirenKO()
    {
        $siret = new Malenki\Codevro\Fr\Siret('4935975790002');

        $this->assertEquals('Malenki\Codevro\Fr\Siren', get_class($siret->getSiren()));
        $this->assertEquals('493597579', $siret->getSiren()->getValue());
    }
    
}



