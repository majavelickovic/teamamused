<!DOCTYPE html>
<!--
Diese Seite stellt die Login-Seite dar, bei welcher sich bereits registrierte User einloggen können.
-->

<?php
// Globale Variablen für die Validierung
global $login;
global $loginValidator;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./design/styles.css">
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
                                <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/user.png"></td><td>Benutzername</td>
                                <td><input type="text" name="benutzername" value="<?php echo isset($this->login) ? $this->login->getBenutzername() : ''; ?>" /></td>
                                <td><span class="error">
                                    <?php echo isset($this->loginValidator) &&
                                        $this->loginValidator->isLoginNameError() ? $this->loginValidator->getLoginNameError() : ""; ?>
                                </span><td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password" value="" /></td>
                                <td><span class="error">
                                    <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isLoginPasswordError() ? $this->loginValidator->getLoginPasswordError() : ""; ?>
                                </span></td>
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

