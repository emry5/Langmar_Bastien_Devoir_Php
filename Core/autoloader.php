
<?php

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload(string $id)
    {
        $file = __DIR__ . '/../App/Model/' . $id . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}
