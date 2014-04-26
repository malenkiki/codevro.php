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

namespace Malenki\Codevro;

/**
 * Code basic root class.
 *
 * This defines the minimal structure to a code, i.e. its value, length, check
 * method and string context.
 *
 * So, every child class cat get value, get length, do check and has a string behaviour.
 *
 * @abstract
 * @package
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
abstract class Code
{
    /**
     * Stores code's value.
     *
     * @var string
     * @access protected
     */
    protected $str_value = null;

    /**
     * Stores code's length.
     *
     * @var integer
     * @access protected
     */
    protected $int_length = 0;

    public function __get($name)
    {
        if (in_array($name, array('value', 'length'))) {
            if ($name == 'value') {
                return $this->str_value;
            }

            return $this->int_length;
        }
    }

    /**
     * Constructor sets code's value and compute internally its length.
     *
     * @param  string $str
     * @access public
     * @return void
     */
    public function __construct($str)
    {
        $this->str_value = (string) $str;
        $this->int_length = strlen($str);
    }



    /**
     * Output code's primitive value.
     *
     * @access public
     * @return string
     */
    public function getValue()
    {
        return $this->str_value;
    }

    /**
     * Gets the code's length.
     *
     * @access public
     * @return integer
     */
    public function getLength()
    {
        return $this->int_length;
    }

    /**
     * Check method signature.
     *
     * Every child class must implement this check methods to tests the code.
     *
     * @abstract
     * @access public
     * @return boolean
     */
    abstract public function check();

    /**
     * How the code must be shown in string context.
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->str_value;
    }
}
