<?php

class CHome
{
	public function get_home() {    //per la visualizzazione della pagina
	$view = USingleton::getInstance('View');
        $session = USingleton::getInstance('USession');

        if($session->is_set('logged')) {
        	$href = 'logout';
        	$icon = 'out';
        	$action = 'Logout';
        	$enabled = true;
        	$dbc = USingleton::getInstance('FDBcustom');
        	$user = $session->get_value('user');
        	$result = $dbc->list($user);
        	for ($i=0; $i < count($result); $i++) { 
        		$stations[$i]['name'] = $result[$i]->getName();
        		$stations[$i]['id'] = $result[$i]->getId();
        	}
        }else{
        	$href = 'login';
        	$icon = 'in';
        	$action = 'Login';
        	$enabled = false;
        	$stations = [];
        }

        $view->setDataIntoTemplate('href', $href);
        $view->setDataIntoTemplate('icon', $icon);
        $view->setDataIntoTemplate('action', $action);
        $view->setDataIntoTemplate('enabled', $enabled);
        $view->setDataIntoTemplate('stations', $stations);


        $view->setTemplate('home.tpl');

        //*
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";//*/

	}
	
	public function post_home() {  // ????
	
	}
}