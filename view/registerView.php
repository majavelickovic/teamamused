<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
echo "hallo";
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    echo "nicht eingeloggt";
    header("Location: http://localhost/TeamAmused/view/loginView.php");
}
?> 


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>test</p>
        <?php
        // put your code here
        ?>
    </body>
</html>
