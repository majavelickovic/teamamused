<!DOCTYPE html>
<!--
Diese Seite stellt die Login-Seite dar, bei welcher sich bereits registrierte User einloggen können.
-->

<?php include_once 'validator/validate.php'; ?>

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
                    <h2>Login</h2>
                    <form method="POST" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/login">
                        <table>
                            <tr>
                                <td><img src="../design/pictures/user.png"></td><td>Benutzername</td>
                                <td><input type="text" name="benutzername" value="" /></td>
                                <td><span class="error"> <?php echo $benutzernameLoginError;?></span><td>
                            </tr>
                            <tr>
                                <td><img src="../design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password" value="" /></td>
                                <span class="error">* <?php echo $passwordLoginError;?></span>
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



?>