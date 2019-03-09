<?php

/**
 * 
 */
class CSignin 
{
	public function get_signin() {    //per la visualizzazione della pagina
		$view = USingleton::getInstance('View');
		$google = USingleton::getInstance('CGoogle');
		$link = $google->getAuthLink();
        $view->setDataIntoTemplate('glink', $link);
        $view->setTemplate('signin.tpl');
	}
	
	public function post_signin() {  // per il post della form
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$password = $_POST['password'];
	}
}