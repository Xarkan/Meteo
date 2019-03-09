<?php


class CFrontController {
    private $controller;
    private $finalmethod;
    private $params = [];
    private $file;
            
    function __construct() {
        include 'config.php';
        $cleared_url = str_replace($config['control']['url_base'], "", $_SERVER['REQUEST_URI']);
        $result = explode("/",$cleared_url);
        
        if(strpbrk($result[0], "?")) {
            $words = explode("?",$result[0]);
            if($words[0] = "google") {
                $formatted_name = ucfirst(strtolower($words[0]));
            }else{
                $formatted_name = "Home";
            }
        }else{
            $formatted_name = ucfirst(strtolower($result[0]));
        }
        
        $this->controller = 'C'.$formatted_name;

        $this->file = $this->controller.".php";
    
        $method = $_SERVER['REQUEST_METHOD'];
        $this->finalmethod = $method.'_'.$formatted_name;

        for ($i=1; $i < count($result); $i++) {
            if(isset($result[$i])) {
                $this->params[$i-1] = $result[$i];
            }    
        }
       
    }

    function run(){
        if(file_exists("Control/".$this->file) && 
            method_exists($this->controller, $this->finalmethod )) {

            $object = new $this->controller();
            $fm = $this->finalmethod;

            return $object->$fm($this->params);     
        }else{
            $view = Usingleton::getInstance('View');
            $view->error('operation');
        }
    }

}