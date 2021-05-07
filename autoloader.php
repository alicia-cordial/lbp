<?php

class Autoloader
{
    //Enregistre l'autoloader
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    //loade la classe demandee
    static function autoload($class)
    {
        $dirs = [
            'controllers',
            'controllers/shop',
            'controllers/user',
            'controllers/admin',
            'models'
        ];

        foreach ($dirs as $dir) {

            if (file_exists($dir . '/' . $class . '.php')) {
                require $dir . '/' . $class . '.php';
                break;
            }
        }
    }
}