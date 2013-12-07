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

/**
 * CreditCardNumberTest 
 * 
 * @see http://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class CreditCardNumberTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests Issuer Identification Number extracted from credit card number
     * 
     * @access public
     * @return void
     */
    public function testIin()
    {
        $c = new Malenki\Codevro\Intl\CreditCardNumber('378282246310005');
        $this->assertEquals('378282', $c->getIin());
    }
    
    public function testMii()
    {
        $c = new Malenki\Codevro\Intl\CreditCardNumber('378282246310005');
        $this->assertEquals('3', $c->getMii());
    }



    public function testCheckOK()
    {
        // use fake valid credit card number used to test Paypal dev
        // See http://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm
        $c = new Malenki\Codevro\Intl\CreditCardNumber('378282246310005');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('371449635398431');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('378734493671000');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('5610591081018250');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('30569309025904');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('38520000023237');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('6011111111111117');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('6011000990139424');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('3530111333300000');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('3566002020360505');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('5555555555554444');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('5105105105105100');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('4111111111111111');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('4012888888881881');
        $this->assertTrue($c->check());
        $c = new Malenki\Codevro\Intl\CreditCardNumber('4222222222222');
        $this->assertTrue($c->check());
    }
}

