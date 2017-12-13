<?php

use service\Service;
use domain\Rechnung;
use controller\ErrorController;

if($_GET['id'] > 0){
    $rg_id = $_GET['id'];
}elseif($_POST['rg_id'] > 0){
    $rg_id = $_POST['rg_id'];
}    
$rgDAO = new dao\RechnungDAO;
$rg = new Rechnung();
$rg = Service::getInstance()->readSingleInvoice($rg_id);
if($rg->getReise() == ""){
    ErrorController::error404View();
}else{

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
        <script src="https://docraptor.com/docraptor-1.0.0.js"></script>
        <script type="text/javascript">
            //Seite nochmals laden, wenn zurücksetzen angeklickt wurde, um die ursprüngliche Rechnung ohne Änderungen anzuzeigen
            function reloadOriginalInvoice(){
                location.reload();
            }
            //Rechnungsseite drucken
            function printInvoice(){      
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
                <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/anzeige" method="POST">
                    <div id="blockleft">
                        <table>
                            <tr>
                                <td colspan="3"><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                            </tr>
                        </table>
			<table>
                            <tr>
                                <td>Rechnungs-ID</td>
                                <td><input type="text" id="rg_id" name="rg_id" style="width:296px;" value="<?php echo $rg_id;?>" readonly/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Reise</td>
				<td>
                                    <select id="reise" name="reise" class="dropdown" style="width:300px;" disabled>
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach(Service::getInstance()->getJourneyTitles() as $key => $invoiceType) {
                                            if($invoiceType['reise_id'] == $rg->getReise()){
                                                echo "<option selected='selected' value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                            }else{
                                                echo "<option value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                            }   
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("reise").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="rgart" name="rgart" class="dropdown" style="width:300px;" disabled>
                                        <?php
                                        // Abfrage für Rechnungsarten
                                        foreach(Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                            if($invoiceType['rgart_id'] == $rg->getRechnungsart()){
                                                echo "<option selected='selected' value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                            }else{
                                                echo "<option value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                            }

                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("rgart").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Kosten</td>
                                <td><input type="text" id="kosten" name="kosten" style="width:296px;" value="<?php echo $rg->getKosten();?>" disabled/></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("kosten").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><textarea id="beschreibung" name="beschreibung" rows="5" cols="35" disabled><?php echo $rg->getBeschreibung();?></textarea></td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("beschreibung").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Dokument</td>
                                <td>
                                    <input id="FileInput" type="text" name="dokument" value="<?php echo $rg->getDokument();?>" style="width:300px;" disabled/>
                                </td>
                                <td>
                                    <a href="#"><img src="../design/pictures/edit.png" onclick="document.getElementById('FileInput').type='file';document.getElementById('FileInput').disabled=false"></a>
                                    <a href="#"><img src="../design/pictures/search.png" onclick="window.open('/showSingleCalcPDF?rg_id='<?php echo$rg_id?>, 'Anzeige PDF')"></a>
                                </td>
                            </tr>
                        </table>
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
                            <td colspan="2" align="center"><input type="button" class="button" value="drucken" onclick="printInvoice()" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="speichern" />  <input type="button" class="button" value="zur&uuml;cksetzen" onclick="reloadOriginalInvoice()"/></td>
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