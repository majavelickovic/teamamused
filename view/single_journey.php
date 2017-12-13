<?php

use service\Service;
use domain\Reise;
use controller\ErrorController;

if($_GET['id'] > 0){
    $reise_id = $_GET['id'];
}elseif($_POST['reise_id'] > 0){
    $reise_id = $_POST['reise_id'];
}    
$reiseDAO = new dao\ReiseDAO;
$reise = new Teilnehmer();
$reise = Service::getInstance()->readSingleJourney($reise_id);
if($reise->getReise() == ""){
    ErrorController::error404View();
}else{

/*
 * View, um eine einzelne Reise anzusehen / zu bearbeiten
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
        <script type="text/javascript">
            //Seite nochmals laden, wenn zurücksetzen angeklickt wurde, um die ursprüngliche Reise ohne Änderungen anzuzeigen
            function reloadOriginalJourney() {
                location.reload();
            }
            //Reiseseite drucken
            function printJourney() {
                window.print();
            }
        </script>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/reise/anzeige" method="POST">
                    <div id="blockleft">
                        <table>
                            <tr>
                                <td colspan="3"><img src="../design/pictures/search.png"></td><td>bestehende Reise anzeigen</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Reise-ID</td>
                                <td><input type="text" id="reise_id" name="reise_id" style="width:296px;" value="<?php echo $reise_id; ?>" readonly/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Reisetitel</td>
                                <td>
                                    <select id="titel" name="titel" class="dropdown" style="width:300px;" disabled>
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyType) {
                                            if ($journeyType['reise_id'] == $reise->getReise()) {
                                                echo "<option selected='selected' value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                            } else {
                                                echo "<option value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("reise").disabled = false'></a></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><textarea id="beschreibung" name="beschreibung" rows="5" cols="35" disabled><?php echo $rg->getBeschreibung(); ?></textarea></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("beschreibung").disabled = false'></a></td>
                            </tr>
                            <tr>
                                <td>Datum von</td>
                                <td><input type="date" name="datum_start" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Datum bis</td>
                                <td><input type="date" name="datum_ende" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td><input type="number" id="preis" name="preis" style="width:296px;" value="<?php echo $reise->getPreis(); ?>" disabled/></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("preis").disabled = false'></a></td>
                            </tr>
                        </table>
                    </div>
                    <div id="blockright">
                        <table>
                            <tr>
                                <td>Startort</td>
                                <td><input type="text" name="startort" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Rechnungen</td>
                                <td><textarea name="rechnungen" rows="4" cols="36"></textarea></td>
                            </tr>
                            <tr>
                                <td>Teilnehmer</td>
                                <td><textarea name="teilnehmer" rows="4" cols="36"></textarea></td>
                            </tr>
                            <tr><td colspan="2"></td></tr>
                            <tr><td colspan="2"></td></tr>
                            <tr><td colspan="2"></td></tr>
                            <tr><td colspan="2"></td></tr>
                            <tr>
                                <td colspan="2" align="center"><input type="button" class="button" value="drucken" onclick="printJourney()" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="speichern" />  <input type="button" class="button" value="zur&uuml;cksetzen" onclick="reloadOriginalJourney()"/></td>
                            </tr>   
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}
?>