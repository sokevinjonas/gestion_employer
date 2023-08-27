<?php
namespace App\Helpers;

use App\Models\Configuration;

Class ConfigHelper {

    public static function getnomApp() 
    {
        $nomApp = Configuration::where('type', 'APP_NAME')->value('value');

        return $nomApp;
        
    }
    public static function getnomDeveloppeur() 
    {
        $nomDeveloppeur = Configuration::where('type', 'DEVELOPPER_NAME')->value('value');

        return $nomDeveloppeur;
        
    }

}