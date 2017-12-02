<?php

use database\Database;
use domain\Rechnung;
use controller\ErrorController;

/*
 * View, um eine einzelne Rechnung anzusehen / zu bearbeiten
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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/profil" ?>">Profil</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                        </tr>
                    </table>
                     <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/anzeige?id="<?php echo"$rg_id"?> method="POST">
			<table>
                            <tr>
                                <td>Rechnungs-ID</td>
                                <td><input type="text" name="rg_id" style="width:296px;" value="<?php echo $rg_id;?>" disabled/></td>
                            </tr>
                            <tr>
                                <td>Reise</td>
				<td>
                                    <select id="dropdown" name="reise" style="width:300px;" disabled>
                                        <?php
                                        $pdo = Database::connect();
                                        $query = $pdo->query("SELECT reise_id, beschreibung FROM reise order by beschreibung asc");

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            if($row['reise_id'] == $rg->getReise()){
                                                echo "<option selected='selected' value='" . $row['reise_id'] . "'>" . $row['beschreibung'] . ", " . $row['reise_id'] . "</option>";
                                            }else{
                                                echo "<option value='" . $row['reise_id'] . "'>" . $row['beschreibung'] . ", " . $row['reise_id'] . "</option>";
                                            }   
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="dropdown" name="rgart" style="width:300px;" disabled>
                                        <?php
                                        $pdo = Database::connect();
                                        $query = $pdo->query("SELECT * FROM rechnungsart order by beschreibung asc");

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            if($row['rgart_id'] == $rg->getRechnungsart()){
                                                echo "<option selected='selected' value='" . $row['rgart_id'] . "'>" . $row['beschreibung'] . "</option>";
                                            }else{
                                                echo "<option value='" . $row['rgart_id'] . "'>" . $row['beschreibung'] . "</option>";
                                            }

                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kosten</td>
                                <td><input type="text" name="kosten" style="width:296px;" value="<?php echo $rg->getKosten();?>" disabled/></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><textarea name="beschreibung" rows="5" cols="35" disabled><?php echo $rg->getBeschreibung();?></textarea></td>
                            </tr>
                            <tr>
                                <td>Dokument</td>
                                <td>
                                    <input id="FileInput" type="text" name="dokument" value="<?php echo $rg->getDokument();?>" style="width:300px;" disabled/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="blockright">
                    <table>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr><td colspan="2"></td></tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="drucken" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="speichern" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>   
                    </table>
                </div>
        </div>
    </div>
</body>
</html>
