<?php

use service\Service;
use domain\Rechnung;
use controller\ErrorController;

if ($_GET['id'] > 0) {
    $rg_id = $_GET['id'];
} elseif ($_POST['rg_id'] > 0) {
    $rg_id = $_POST['rg_id'];
}
$rg = new Rechnung();
$rg = Service::getInstance()->readSingleInvoice($rg_id);
if ($rg->getReise() == "") {
    ErrorController::error404View();
} else {

    /*
     * View, um eine einzelne Rechnung anzusehen / zu bearbeiten
     * @author Maja Velickovic
     */
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../design/styles.css">
            <title>Rechnung</title>
            <script type="text/javascript">
                //Seite nochmals laden, wenn zurücksetzen angeklickt wurde, um die ursprüngliche Rechnung ohne Änderungen anzuzeigen
                function reloadOriginalInvoice() {
                    location.reload();
                }
                //Rechnungsseite drucken
                function printInvoice() {
                    window.print();
                }
                //Prüfe Eingaben in Formular
                function checkForm(){
                    $countError = 0;
                    if(document.getElementById("reise").value == ""){
                        document.getElementById("reiseError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("reiseError").style.display = "none";
                    }
                    if(document.getElementById("rgart").value == ""){
                        document.getElementById("rgartError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("rgartError").style.display = "none";
                    }
                    if(document.getElementById("kosten").value == ""){
                        document.getElementById("kostenError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("kostenError").style.display = "none";
                    }
                    if(document.getElementById("beschreibung").value == ""){
                        document.getElementById("beschreibungError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("beschreibungError").style.display = "none";
                    }
                    if(document.getElementById("dokument").files[0].size > 2097152){
                        document.getElementById("dokumentError").style.display = "inline";
                        $countError = $countError+1;
                    }else{
                        document.getElementById("dokumentError").style.display = "none";
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
                    <form id="rgForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/anzeige" method="POST"  enctype="multipart/form-data">
                        <div id="blockleft">
                            <table>
                                <tr>
                                    <td colspan="3"><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>Rechnungs-ID</td>
                                    <td><input type="text" id="rg_id" name="rg_id" size="40px" value="<?php echo $rg_id; ?>" readonly/></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Reise</td>
                                    <td>
                                        <select id="reise" name="reise" class="dropdown" disabled>
                                            <?php
                                            //Abfrage für Reisetitel
                                            foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyTitle) {
                                                if ($journeyTitle['reise_id'] == $rg->getReise()) {
                                                    echo "<option selected='selected' value='" . $journeyTitle['reise_id'] . "'>" . $journeyTitle['titel'] . ", " . $journeyTitle['reise_id'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $journeyTitle['reise_id'] . "'>" . $journeyTitle['titel'] . ", " . $journeyTitle['reise_id'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("reise").disabled = false'></a></td>
                                    <td>
                                        <div id="reiseError" class="error" style="display: none;">
                                            Bitte Reise selektieren.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rechnungsart</td>
                                    <td>
                                        <select id="rgart" name="rgart" class="dropdown" disabled>
                                            <?php
                                            // Abfrage für Rechnungsarten
                                            foreach (Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                                if ($invoiceType['rgart_id'] == $rg->getRechnungsart()) {
                                                    echo "<option selected='selected' value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("rgart").disabled = false'></a></td>
                                    <td>
                                        <div id="rgartError" class="error" style="display: none;">
                                            Bitte Rechnungsart selektieren.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kosten</td>
                                    <td><input type="text" id="kosten" name="kosten" style="width:308px;" value="<?php echo $rg->getKosten(); ?>" disabled/></td>
                                    <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("kosten").disabled = false; document.getElementById("kosten").type = "number"; document.getElementById("kosten").min = "0"; document.getElementById("kosten").max = "999999";'></a></td>
                                    <td>
                                        <div id="kostenError" class="error" style="display: none;">
                                                Bitte Kosten eingeben.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Beschreibung</td>
                                    <td><textarea id="beschreibung" name="beschreibung" rows="5" cols="36" disabled><?php echo $rg->getBeschreibung(); ?></textarea></td>
                                    <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("beschreibung").disabled = false'></a></td>
                                    <td>
                                        <div id="beschreibungError" class="error" style="display: none;">
                                                Bitte Beschreibung eingeben.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokument</td>
                                    <td>
                                        <input id="dokument" type="text" name="dokument" style="width:308px;" value="<?php echo $rg->getDokument(); ?>" disabled/>
                                    </td>
                                    <td>
                                        <a href="#"><img src="../design/pictures/edit.png" onclick="document.getElementById('dokument').type = 'file';document.getElementById('dokument').disabled = false;document.getElementById('dokument').accept = 'application/pdf';"></a>
                                        <a href="#"><img src="../design/pictures/search.png" onclick="window.open('/showSingleCalcPDF?rg_id=<?php echo $rg_id; ?>', 'Anzeige PDF')"></a>
                                    </td>
                                    <td>
                                        <div id="dokumentError" class="error" style="display: none;">
                                            PDF darf nicht grösser als 2MB sein.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center"><input type="button" class="button" value="zur&uuml;cksetzen" onclick="reloadOriginalInvoice()"/><input type="button" class="button" value="speichern" onclick="checkForm();"/><input type="button" class="button" value="zur&uuml;ck" onclick="window.location.href='/rechnung/bestehend'" /></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center"><input type="button" class="button" value="drucken" onclick="printInvoice()" /></td>
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