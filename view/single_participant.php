<?php

use service\Service;
use domain\Teilnehmer;
use controller\ErrorController;

if($_GET['id'] > 0){
    $teilnehmer_id = $_GET['id'];
}elseif($_POST['teilnehmer_id'] > 0){
    $teilnehmer_id = $_POST['teilnehmer_id'];
}    
$teilnehmerDAO = new dao\TeilnehmerDAO;
$teilnehmer = new Teilnehmer();
$teilnehmer = Service::getInstance()->readSingleParticipant($teilnehmer_id);
if($teilnehmer->getReise() == ""){
    ErrorController::error404View();
}else{

/*
 * View, um einen einzelnen Teilnehmer anzusehen / zu bearbeiten
 * @author Sandra Bodack
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Teilnehmer</title>
        <script type="text/javascript">
            //Seite nochmals laden, wenn zurücksetzen angeklickt wurde, um den ursprünglichen Teilnehmer ohne Änderungen anzuzeigen
            function reloadOriginalParticipant() {
                location.reload();
            }
            //Teilnehmerseite drucken
            function printParticipant() {
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
                <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/teilnehmer/anzeige" method="POST">
                    <div id="blockleft">
                        <table>
                            <tr>
                                <td colspan="3"><img src="../design/pictures/search.png"></td><td>bestehender Teilnehmer anzeigen</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Teilnehmer-ID</td>
                                <td><input type="text" id="teilnehmer_id" name="teilnehmer_id" size="40px" value="<?php echo $teilnehmer_id; ?>" readonly/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="reise" name="reise" class="dropdown" disabled>
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyType) {
                                            if ($journeyType['reise_id'] == $teilnehmer->getReise()) {
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
                                <td>Vorname</td>
                                <td><input type="text" id="vorname" name="vorname" size="40px" value="<?php echo $teilnehmer->getVorname();?>" disabled/></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("vorname").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type="text" id="nachname" name="nachname" size="40px" value="<?php echo $teilnehmer->getNachname();?>" disabled/></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("nachname").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Geburtsdatum</td>
                                <td><input type="text" id="geburtsdatum" name="geburtsdatum" size="40px" value="<?php echo $teilnehmer->getGeburtsdatum();?>" disabled/></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("geburtsdatum").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="button" class="button" value="drucken" onclick="printParticipant()" />  <input type="button" class="button" value="zur&uuml;ck" onclick="" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="speichern" />  <input type="button" class="button" value="zur&uuml;cksetzen" onclick="reloadOriginalParticipant()"/></td>
                            </tr> 
                        </table>
                    </div>
                    <div id="blockright">

                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}
?>