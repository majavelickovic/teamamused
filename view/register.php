<!DOCTYPE html>
<!--
Diese Seite stellt die Registrierungs-Seite dar, bei welcher sich neue User registrieren können.
-->
<?php
// Globale Variablen für die Validierung
global $login;
global $loginValidator;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Registrierung</title>
    </head>
    <body>
        <div id="whiteblock">
            <div id="block">
                <div id="blockleft">
                    <h1>Verwaltung der Reisen</h1>
                    <h2>Registrierung</h2>
                    <form method="POST" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/register">
                        <table>
                            <tr>
                                <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/user.png"></td><td>Benutzername</td>
                                <td><input type="text" name="benutzername" value="" /></td>
                                <td><span class="error">
                                        <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isRegisterNameError() ? $this->loginValidator->getRegisterNameError() : ""; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" value=""/></td>
                                <td><span class="error">
                                        <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isRegisterVornameError() ? $this->loginValidator->getRegisterVornameError() : ""; ?>
                                    </span>
                                </td>                                
                            </tr>
                            <tr>
                                <td></td>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" value="" /></td>
                                <td><span class="error">
                                        <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isRegisterNachnameError() ? $this->loginValidator->getRegisterNachnameError() : ""; ?>
                                    </span>
                                </td> 
                            </tr>
                            <tr>
                                <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password1" value="" /></td>
                                <td><span class="error">
                                        <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isRegisterPassword1Error() ? $this->loginValidator->getRegisterPassword1Error() : ""; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Passwort bestätigen</td>
                                <td><input type="password" name="password2" value="" /></td>
                                <td><span class="error">
                                        <?php echo isset($this->loginValidator) &&
                                            $this->loginValidator->isRegisterPassword2Error() ? $this->loginValidator->getRegisterPassword2Error() : ""; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="center"><input type="submit" id="submitButton" class="button" value="registrieren" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="<?php echo $GLOBALS["ROOT_URL"] . "/login" ?>"> zum Login</a></td></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
