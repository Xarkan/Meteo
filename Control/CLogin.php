<?php 

class CLogin 
{
	
    public function post_login() {        
        include 'config.php';
        $dbm = USingleton::getInstance('FDBmanager');
        $session = USingleton::getInstance('USession');        

        $mail = $_POST['mail'];   //'test@gmail.com';
        $psw =  $_POST['password'];    //'password';
        //$is_station = 'prova';  // ['station'] e ['name'] devono essere uguali 

        $user = new EUser($mail,$psw);

        //controlla se è registrato
        if($dbm->exist($user)) {
            $user = $dbm->load($user);
            //controlla se la psw è giusta
            if ($psw === $user->getPassword()) {
                $session->set_value('logged',true);
                $domain = explode('@', $mail);
                //controlla che non è un admin
                if($domain[1] != $config['control']['domain']) {
                    $session->set_value('user',$user);
                    //controlla se è una stazione
                    if(isset($_POST['station'])) {
                        $temp = new EStation($user, $_POST['station']);
                        $exist = $dbm->exist($temp);
                        //controlla se è il primo accesso
                        if(!$exist) {
                            $cstation = new CStation($user);
                            $cstation->save();
                        }else{
                            $station = $dbm->load($temp);
                            $session->set_value('station', $station);
                        }
                    //se non è una stazione allora è un utente
                    }else{
                        $view = USingleton::getInstance('View');
                        if($session->is_set('page')) {
                            $page = $session->get_value('page');
                        }else{
                            $page = $config['template']['home'];                           
                        }
                    $view->redirect($page);
                    }
                //nel caso sia un admin    
                }else{
                    $user = 'admin';
                    $session->set_value('user',$user);
                }
            //è registrato ma la password è sbagliata    
            }else{
                $view = USingleton::getInstance('View');
                $view->error('password');
            }
        // non è registrato    
        }else{
            $view = USingleton::getInstance('View');
            $view->error('access');
        }

    }


    public function get_login() {
        $view = USingleton::getInstance('View');
        $google = USingleton::getInstance('CGoogle');
        $link = $google->getAuthLink();
        $view->setDataIntoTemplate('glink', $link);
        $view->setTemplate('login.tpl');
        
    }    
        

}