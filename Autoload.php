<?php
function my_autoloader($className) {
    switch ($className[0]) {
        case 'V':
            require_once (__DIR__ . '/View/'.$className.'.php');
            break;
        case 'F':
            require_once (__DIR__ . '/Foundation/'.$className.'.php');
            break;
        case 'E':
            require_once (__DIR__ . '/Entity/'.$className.'.php');
            break;
        case 'C':
            require_once (__DIR__ . '/Control/'.$className.'.php');
            break;
        case 'U':
            require_once (__DIR__ . '/Utility/'.$className.'.php');
            break;
    }
}
spl_autoload_register('my_autoloader');