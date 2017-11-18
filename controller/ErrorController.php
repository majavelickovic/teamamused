<?php //

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use view\view as View;

class ErrorController
{

    public static function error404View(){
      echo (new View("error404.php"))->render();
    }
    
    public static function error403View(){
      echo (new View("error403.php"))->render();
    }
    
}
?>