<!DOCTYPE html>
<!--
Diese Seite stellt die Login-Seite dar, bei welcher sich bereits registrierte User einloggen können.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Login</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="blockleft">
                    <h1>Verwaltung der Reisen</h1>
                    Login<br><br>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <table>
                            <tr>
                                <td><img src="../design/pictures/user.png"></td><td>Benutzername</td>
                                <td><input type="text" name="benutzername" value="" /></td>
                            </tr>
                            <tr>
                                <td><img src="../design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password" value="" /></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="center"><input type="submit" class="button" value="einloggen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="right"><a href="<?php echo $GLOBALS["ROOT_URL"] . "/register" ?>"> zur Registrierung</a></td></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

//        if (isset($_POST['sub'])) {
//            include_once './../validator/validate.php';
//            if (validateLogin()) {
//                $userID = intval($_POST['userID']);
//                $password = $_POST['password'];
//                if ($userID == 1 && $password == "test") {
//                    $_SESSION['login'] = true;
//                }
// HIER: Versuch mit DB-Anbindung -> anstelle Zeile 20
#$service = new Service();
#if($service->verifyUser($userID, $password)){
#    $_SESSION['login'] = true;
#} else {
#    $_SESSION['login'] = false;                    
#}
//            }
//        }

?>