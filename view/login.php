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
                    Login</br></br>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <table>
                            <tr>
                                <td><img src="../design/pictures/user.png"></td><td>User-ID</td>
                                <td><input type="text" name="userID" value="" /></td>
                            </tr>
                            <tr>
                                <td><img src="../design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password" value="" /></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3"><input type="submit" value="einloggen" name="sub" /> <input type="reset" value="zur&uuml;cksetzen" /></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="right"><a href=<?php echo $GLOBALS["ROOT URL"]; ?> zur Registrierung</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
// Session starten oder vorhandene übernehmen
//        session_start();
//
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