<?php

use service\Service;

/*
 * View, um einen neuen Teilnehmer zu erfassen
 * @author Sandra Bodack
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Teilnehmer</title>
        <script type="text/javascript">
                //Prüfe Eingaben in Formular
                function checkForm(){
                    $countError = 0;
                    if(document.getElementById("reise").value == ""){
                        document.getElementById("reiseError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("reiseError").style.display = "none";
                    }
                    if(document.getElementById("vorname").value == ""){
                        document.getElementById("vornameError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("vornameError").style.display = "none";
                    }
                    if(document.getElementById("nachname").value == ""){
                        document.getElementById("nachnameError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("nachnameError").style.display = "none";
                    }
                    if(document.getElementById("geburtsdatum").value == ""){
                        document.getElementById("geburtsdatumError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("geburtsdatumError").style.display = "none";
                    }
                    if($countError == 0){
                        var req = new XMLHttpRequest();
                        req.open('GET', '/assets/maxParticipantReachedForJourney?reise=' + document.getElementById("reise").value);

                        //Prüfe, ob maximale Teilnehmeranzahl bereits erreicht wurde
                        req.onreadystatechange = function () {
                            if (req.readyState == 4 && req.status == 200) {
                                if(req.responseText.toString() == "true"){
                                    alert("maximale Teilnehmeranzahl für Reise bereits erreicht. Es können keine weiteren Teilnehmer für diese Reise erfasst werden.");
                                }else{
                                    document.getElementById("participantForm").submit();
                                }
                            }
                        }
                        req.send(null);
                    }
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
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neuer Teilnemer hinzufügen</td>
                        </tr>
                    </table>
                    <form id="participantForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/teilnehmer/neu" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="reise" name="reise" class="dropdown">
                                        <?php
                                        if ($_POST['reise'] == "") {
                                            echo "<option selected='selected' value=''></option>";
                                        } else {
                                            echo "<option value=''></option>";
                                        }
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyType) {
                                            echo "<option value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <div id="reiseError" class="error" style="display: none;">
                                        Bitte Reise auswählen.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Vorname</td>
                                <td><input id="vorname" type="text" name="vorname" size="40px" /></td>
                                <td>
                                    <div id="vornameError" class="error" style="display: none;">
                                        Bitte Vorname eingeben.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input id="nachname" type="text" name="nachname" size="40px" /></td>
                                <td>
                                    <div id="nachnameError" class="error" style="display: none;">
                                        Bitte Nachname eingeben.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Geburtsdatum</td>
                                <td><input id="geburtsdatum" type="date" name="geburtsdatum" /></td>
                                <td>
                                    <div id="geburtsdatumError" class="error" style="display: none;">
                                        Bitte Geburtsdatum eingeben.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="button" class="button" value="hinzuf&uuml;gen" onclick="checkForm();"/>  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
