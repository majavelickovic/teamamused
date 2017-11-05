<?php
/**
 * Created by PhpStorm.
 * User: andreas.martin
 * Date: 09.10.2017
 * Time: 08:30
 */

namespace controller;

use service\Service;

class AuthentifizController
{
    /*
     * Überprüft, ob die Session-Variable gesetzt ist und validiert das Token
     */
    public static function authenticate(){
        if (isset($_SESSION['login'])) {
            if(Service::getInstance()->validateToken($_SESSION['login']['token'])) {
                return true;
            }
        }
        return false;
    }

    public static function login(){
        if(Service::getInstance()->verifyUser($_POST['userId'],$_POST['password']))
        {
            $_SESSION['user']['token'] = Service::getInstance()->issueToken();
        }
    }

}