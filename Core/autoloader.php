
<?php

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload(string $id)
    {
        $dossiers = [
            __DIR__ . '/../App/Model/',
            __DIR__ . '/../App/Controller/'
        ];

        foreach ($dossiers as $dossier) {
            $file = $dossier . $id . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
}
