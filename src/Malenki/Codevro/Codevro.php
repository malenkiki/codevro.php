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

class Codevro
{
    public static function autoload($str_class_name)
    {
        $str_this_class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        $str_base_dir = __DIR__;

        if (substr(__DIR__, -strlen($str_this_class)) === $str_this_class)
        {
            $str_base_dir = substr(__DIR__, 0, - strlen($str_this_class));
        }

        $str_class_name = ltrim($str_class_name, '\\');
        $str_file_name  = $str_base_dir;

        $str_namespace = '';
        
        if ($int_last_ns_pos = strripos($str_class_name, '\\'))
        {
            $str_namespace = substr($str_class_name, 0, $int_last_ns_pos);
            $str_class_name = substr($str_class_name, $int_last_ns_pos + 1);
            $str_file_name  .= str_replace('\\', DIRECTORY_SEPARATOR, $str_namespace) . DIRECTORY_SEPARATOR;
        }

        $str_file_name .= str_replace('_', DIRECTORY_SEPARATOR, $str_class_name) . '.php';

        if (file_exists($str_file_name))
        {
            require $str_file_name;
        }
    }



    public static function registerAutoloader()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Codevro::autoload");
    }

}
