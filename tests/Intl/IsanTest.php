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
 * Some examples: Inception: 0000-0002-B3C8-0000-3
 * Stargate Atlantis - Season 1 - Disc 2: 0000-0000-DDB0-0069-Q
 * Stargate Atlantis - Season 1 - Disc 3: 0000-0000-DDB0-006A-O
 * Stargate Atlantis - Season 1 - Disc 4: 0000-0000-DDB0-006B-M
 * Exazmple taken from official documentation: B159-D8FA-0124-0000-K
 * @copyright 2014 Michel PETIT
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class IsanTest extends PHPUnit_Framework_TestCase
{

    public function testIsanInstanciationShoudBeOk()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00069Q');
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AO');
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006BM');
        $s = new Malenki\Codevro\Intl\Isan('B159D8FA01240000K');
    }

    public function testCheckingGoogIsanMustSuccess()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00069Q');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AO');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006BM');
        $this->assertTrue($s->check());
        $s = new Malenki\Codevro\Intl\Isan('B159D8FA01240000K');
        $this->assertTrue($s->check());
    }

    public function testCheckingBadIsanMustFail()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800002');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00049Q');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AT');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Isan('00001000DDB0006BM');
        $this->assertFalse($s->check());
        $s = new Malenki\Codevro\Intl\Isan('B169D8FA01240000K');
        $this->assertFalse($s->check());
    }

    public function testGettingEpisodePartSouldBeRightPart()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $this->assertEquals('0000', $s->getEpisode());
        $this->assertEquals('0000', $s->episode);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00069Q');
        $this->assertEquals('0069', $s->getEpisode());
        $this->assertEquals('0069', $s->episode);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AO');
        $this->assertEquals('006A', $s->getEpisode());
        $this->assertEquals('006A', $s->episode);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006BM');
        $this->assertEquals('006B', $s->getEpisode());
        $this->assertEquals('006B', $s->episode);
        $s = new Malenki\Codevro\Intl\Isan('B159D8FA01240000K');
        $this->assertEquals('0000', $s->getEpisode());
        $this->assertEquals('0000', $s->episode);
    }

    public function testGettingRootPartSouldBeRightPart()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $this->assertEquals('00000002B3C8', $s->getRoot());
        $this->assertEquals('00000002B3C8', $s->root);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00069Q');
        $this->assertEquals('00000000DDB0', $s->getRoot());
        $this->assertEquals('00000000DDB0', $s->root);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AO');
        $this->assertEquals('00000000DDB0', $s->getRoot());
        $this->assertEquals('00000000DDB0', $s->root);
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006BM');
        $this->assertEquals('00000000DDB0', $s->getRoot());
        $this->assertEquals('00000000DDB0', $s->root);
        $s = new Malenki\Codevro\Intl\Isan('B159D8FA01240000K');
        $this->assertEquals('B159D8FA0124', $s->getRoot());
        $this->assertEquals('B159D8FA0124', $s->root);
    }

    public function testFormatedIsanShouldBeWellFormated()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $this->assertEquals('ISAN 0000-0002-B3C8-0000-3', $s->format());
        $this->assertEquals('ISAN 0000-0002-B3C8-0000-3', "$s");
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB00069Q');
        $this->assertEquals('ISAN 0000-0000-DDB0-0069-Q', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-0069-Q', "$s");
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006AO');
        $this->assertEquals('ISAN 0000-0000-DDB0-006A-O', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-006A-O', "$s");
        $s = new Malenki\Codevro\Intl\Isan('00000000DDB0006BM');
        $this->assertEquals('ISAN 0000-0000-DDB0-006B-M', $s->format());
        $this->assertEquals('ISAN 0000-0000-DDB0-006B-M', "$s");
        $s = new Malenki\Codevro\Intl\Isan('B159D8FA01240000K');
        $this->assertEquals('ISAN B159-D8FA-0124-0000-K', $s->format());
        $this->assertEquals('ISAN B159-D8FA-0124-0000-K', "$s");
    }

    public function testFormatedIsanAsUrnShouldBeWellFormated()
    {
        $s = new Malenki\Codevro\Intl\Isan('00000002B3C800003');
        $this->assertEquals('URN:ISAN:0000-0002-B3C8-0000-3', $s->getUrn());
        $this->assertEquals('URN:ISAN:0000-0002-B3C8-0000-3', $s->urn);
    }
}
