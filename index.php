<?php   
        //error_reporting(E_WARNING);
     
        require_once 'Autoload.php';
        require_once 'config.php';
        //require_once 'Utility/vendor/autoload.php';
        
        $controller = USingleton::getInstance('CFrontController');
        $controller->run();