<?php //

/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Der Controller stellt Methoden für das Rendering der Error-Views bereit
 * 
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