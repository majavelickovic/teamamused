<!DOCTYPE html>
<!--
Diese Seite stellt die Registrierungs-Seite dar, bei welcher sich neue User registrieren können.
-->
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
                    Registrierung</br></br>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <table>
                            <tr>
                                <td><img src="../design/pictures/user.png"></td><td>Benutzername</td>
                                <td><input type="text" name="benutzername" value="" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" value="" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" value="" /></td>
                            </tr>
                            <tr>
                                <td><img src="../design/pictures/key.png"></td><td>Passwort</td>
                                <td><input type="password" name="password1" value="" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Passwort bestätigen</td>
                                <td><input type="password" name="password2" value="" /></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3" align="center"><input type="submit" class="button" value="registrieren" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
/* echo "hallo";
  session_start();

  if(!isset($_SESSION['login']) || $_SESSION['login'] == false) {
  echo "nicht eingeloggt";
  header("Location: http://localhost/TeamAmused/view/loginView.php");
  } */
?>