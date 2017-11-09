<?php

use database\Database;

/*
 * View, um eine neue Rechnung zu erfassen
 */
?>

<!DOCTYPE html>
<!--
Diese Seite stellt die Rechnungs-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="#reise">Reise</a></li>
                        <li><a href="#rechnung">Rechnung</a></li>
                        <li><a href="#teilnehmer">Teilnehmer</a></li>
                        <li><a href="#profil">Profil</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neue Rechnung hinzufügen</td>
                        </tr>
                    </table>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
			<table>
                            <tr>
                                <td>Reise</td>
				<td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                        $pdo = Database::connect();
                                        $query = $pdo->query("SELECT reise_id, beschreibung FROM reise order by beschreibung asc");

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['reise_id'] . "'>" . $row['beschreibung'] . ", " . $row['reise_id'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="dropdown" name="rgart" style="width:300px;">
                                        <?php
                                        $pdo = Database::connect();
                                        $query = $pdo->query("SELECT beschreibung FROM rechnungsart order by beschreibung asc");

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['beschreibung'] . "'>" . $row['beschreibung'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <td>Kosten</td>
                            <td><input type="text" name="preis" style="width:296px;"/></td>
                        </tr>
                        <tr>
                            <td>Beschreibung</td>
                            <td><textarea name="beschreibung" rows="5" cols="35"></textarea></td>
                        </tr>
                        <tr>
                            <td>Dokument</td>
                            <td>
                                <input id="FileInput" type="file" name="rgdatei" style="width:300px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="hinzuf&uuml;gen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>