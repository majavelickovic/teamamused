<?php

use service\Service;

/*
 * View, um eine neue Rechnung zu erfassen
 * @author Maja Velickovic
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
        <script type="text/javascript">
            //Fehlermeldungen Defaultmässig ausblenden
            document.getElementById("reiseError").style.visibility = "hidden";
            document.getElementById("rgartError").style.visibility = "hidden";
            document.getElementById("kostenError").style.visibility = "hidden";
            document.getElementById("beschreibungError").style.visibility = "hidden";
            
            //Prüfen, ob alle Anngaben im Formular gemacht wurden
            function checkForm() {
                $countError = 0;
                if(document.getElementById("reise").value == ""){
                    document.getElementById("reiseError").style.visibility = "none";
                    $countError = $countError+1;
                }
                if(document.getElementById("rgart").value == ""){
                    document.getElementById("rgartError").style.visibility = "none";
                    $countError = $countError+1;
                }
                if(document.getElementById("kosten").value == ""){
                    document.getElementById("kostenError").style.visibility = "none";
                    $countError = $countError+1;
                }
                if(document.getElementById("beschreibung").value == ""){
                    document.getElementById("beschreibungError").style.visibility = "none";
                    $countError = $countError+1;
                }
                if($countError == 0){
                    document.getElementById("rgForm").submit();
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
                            <td><img src="../design/pictures/plus.png"></td><td>neue Rechnung hinzufügen</td>
                        </tr>
                    </table>
                    <form id="rgForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/neu" method="POST" enctype="multipart/form-data">
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
                                        foreach(Service::getInstance()->getJourneyTitles() as $key => $journeyTitle) {
                                            echo "<option value='" . $journeyTitle['reise_id'] . "'>" . $journeyTitle['titel'] . ", " . $journeyTitle['reise_id'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span id="reiseError" class="error">
                                        Bitte Reise selektieren.
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="rgart" name="rgart" class="dropdown">
                                        <?php
                                        if ($_POST['rgart'] == "") {
                                            echo "<option selected='selected' value=''></option>";
                                        } else {
                                            echo "<option value=''></option>";
                                        }
                                        // Abfrage für Rechnungsarten
                                        foreach(Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                            echo "<option value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                        }
                                        
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span id="rgartError" class="error">
                                        Bitte Reise selektieren.
                                    </span>
                                </td>
                        </tr>
                        <tr>
                            <td>Kosten</td>
                            <td><input id="kosten" type="number" name="kosten" style="width:308px;" min="0" max="999999"/></td>
                            <td>
                                <span id="kostenError" class="error">
                                        Bitte Reise selektieren.
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Beschreibung</td>
                            <td><textarea id="beschreibung" name="beschreibung" rows="5" cols="36"></textarea></td>
                            <td>
                                <span id="beschreibungError" class="error">
                                        Bitte Reise selektieren.
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokument</td>
                            <td>
                                <input id="dokument" type="file" name="dokument" style="width:308px;" accept="application/pdf"/>
                            </td>
                            <td></td>
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