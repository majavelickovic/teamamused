<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace database;

use PDO;

class Database
{
    public static function connect()
    {
        $host = "ec2-176-34-111-152.eu-west-1.compute.amazonaws.com";
        $port = "5432";
        $db = "dbabpfc2jh2nbo";
        $username = "ztdczgwqtyarlj";
        $password = "d314d8b083f6178b1a5be24bb6e57c118b74d436179cbedeff73f7a843344fdc";
        
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db;user=$username;password=$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
    public static function close($pdo){
        this.$pdo->close();
    }

}

?>