<?php

require('smarty-libs/Smarty.class.php');

class View extends Smarty {

    public function __construct() {
        include 'config.php';
        parent::__construct();
        $this->setTemplateDir($config['template']['dir'].'templates');   
        $this->setCompileDir($config['template']['dir'].'templates_c');
        $this->setCacheDir($config['template']['dir'].'cache');
        $this->setConfigDir($config['template']['dir'].'configs');  
    }

    public function setTemplate( $template ) {
        $this->display( $template );
    }

    public function setDataIntoTemplate( $reference, $data  ) {
        $this->assign( $reference, $data );
    } 

    public function redirect($page) {
        include 'config.php';
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: '.$config['control']['url_base'].$page);
    }
    
    public function print_json($object) {
        $json = json_encode($object);
        echo $json;
    }

    public function error($string) {
    	switch ($string) {
    		case 'access':
    			header('HTTP/1.1 401 Unauthorized');
    			break;
            case 'password':
                echo "Error! Wrong password.";
                break;    
    		case 'operation':
    			header('HTTP/1.1 404 Not Found');
    			break;
    	}
    	
    }
}