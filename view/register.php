<!DOCTYPE html>
<!--
Diese Seite stellt die Registrierungs-Seite dar, bei welcher sich neue User registrieren können.
-->
<?php include_once 'validator/validate.php'; ?>

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
                                <td><span class="error"> <?php echo $benutzernameRegisterError;?></span><td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" value="" /></td>
                                <td><span class="error"> <?php echo $vornameRegisterError;?></span><td>                                
                            </tr>
                            <tr>
                                <td></td>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" value="" /></td>
                                <td><span class="error"> <?php echo $nachnameRegisterError;?></span><td> 
                            </tr>
                            <tr>
                                <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password1" value="" /></td>
                                <td><span class="error"> <?php echo $password1RegisterError;?></span><td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Passwort bestätigen</td>
                                <td><input type="password" name="password2" value="" /></td>
                                <td><span class="error"> <?php echo $password2RegisterError;?></span><td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="center"><input type="submit" class="button" value="registrieren" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
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

