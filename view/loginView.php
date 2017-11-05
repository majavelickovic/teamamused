<!DOCTYPE html>
<!--
Diese Seite stellt die Login-Seite dar, bei welcher sich bereits registrierte User einloggen können.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verwaltung der Reisen</title>
    </head>
    <body>
        <?php
        // Session starten oder vorhandene übernehmen
        session_start();
        
        if(isset($_POST['sub'])) {
            include_once './../validator/validate.php';
            if(validateLogin()) {
                $userID = intval($_POST['userID']);
                $password = $_POST['password'];
                if($userID == 1 && $password == "test") {
                    $_SESSION['login'] = true;
                }
                
                // HIER: Versuch mit DB-Anbindung -> anstelle Zeile 20
                #$service = new Service();
                #if($service->verifyUser($userID, $password)){
                #    $_SESSION['login'] = true;
                #} else {
                #    $_SESSION['login'] = false;                    
                #}
            }
        }
        
        // Session beenden -> session_destroy() reicht nicht
        //session_destroy();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
//        if (ini_get("session.use_cookies")) {
//            $params = session_get_cookie_params();
//            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
//            );
//        }
        ?>
        <h3>Login</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <table>
                <tr>
                    <td>icon</td><td>User-ID</td>
                    <td><input type="text" name="userID" value="" /><br/></td>
                </tr>
                <tr>
                    <td>icon</td><td>Passwort</td>
                    <td><input type="password" name="password" value="" /><br/></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="einloggen" name="sub" /> <input type="reset" value="zurücksetzen" /></td>
                </tr>
                <tr>
                <br>
                <td></td>
                <td></td>
                <td><a href='registerView.php'>zur Registrierung</a></td>
                </tr>
            </table>
        </form>
        <br/>
    </body>
</html>