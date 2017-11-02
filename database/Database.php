<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database
{
    public static function connect()
    {
        $pdo = new PDO('mysql:host=jdbc:postgresql://ec2-176-34-111-152.eu-west-1.compute.amazonaws.com:5432/dbabpfc2jh2nbo;dbname=Heroku DB','root', '');

        return $pdo;
    }

}

?>