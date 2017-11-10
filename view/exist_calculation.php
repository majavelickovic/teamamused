<!DOCTYPE html>
<!--
Diese Seite stellt die Rechnungs-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
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
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                        </tr>
                    </table>
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
                            <td>Rechnung-ID</td>
                            <td><input type="text" name="rg_id" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Rechnungsart</td>
                            <td>
                                <select id="dropdown" name="rgart" style="width:300px;">
                                    <?php
                                        $pdo = Database::connect();
                                        $query = $pdo->query("SELECT * FROM rechnungsart order by beschreibung asc");

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['rgart_id'] . "'>" . $row['beschreibung'] . "</option>";
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
