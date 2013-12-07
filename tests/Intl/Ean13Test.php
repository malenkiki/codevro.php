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


(@include_once __DIR__ . '/../../vendor/autoload.php') || @include_once __DIR__ . '/../../../../autoload.php';

class Ean13Test extends PHPUnit_Framework_TestCase
{

    public function testIsbnOK()
    {
        $s = new Malenki\Codevro\Intl\Ean13('9782359220223');
        $this->assertTrue($s->isIsbn());
        
        $s = new Malenki\Codevro\Intl\Ean13('978-2359220223');
        $this->assertTrue($s->isIsbn());
    }
    
    public function testIsbnKO()
    {
        $s = new Malenki\Codevro\Intl\Ean13('3020120022109');
        $this->assertFalse($s->isIsbn());
        
        $s = new Malenki\Codevro\Intl\Ean13('3-02012-002210-9');
        $this->assertFalse($s->isIsbn());
    }


    public function testCheckOK()
    {
        $s = new Malenki\Codevro\Intl\Ean13('9782359220223');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Intl\Ean13('978-2359220223');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Intl\Ean13('3020120022109');
        $this->assertTrue($s->check());
        
        $s = new Malenki\Codevro\Intl\Ean13('3-02012-002210-9');
        $this->assertTrue($s->check());
    }
}
