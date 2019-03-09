<?php


class CLogout {

	public function post_logout() {
        $session = USingleton::getInstance('USession');
        $session->distruggiSessioneCookie();
        $view = USingleton::getInstance('View');
        $view->setTemplate('home.tpl');
    }
    
    public function get_logout() {
        $session = USingleton::getInstance('USession');
        $session->distruggiSessioneCookie();
        $view = USingleton::getInstance('View');
        $view->redirect('home');
    }
}