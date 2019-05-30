<?php
// Load Config
require_once 'config/config.php';

// Load Helpers
foreach(glob(APPROOT . '\helpers\*.php') as $file){
    
	require_once $file;

}

//Autoload Core Libraries
spl_autoload_register(function($className){

	require_once 'libraries/' . $className . '.php';

});