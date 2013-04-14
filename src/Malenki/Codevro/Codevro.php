<?php

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
