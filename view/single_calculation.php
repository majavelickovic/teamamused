<?php

use database\Database;
use domain\Rechnung;
use controller\ErrorController;

if($_GET['id'] > 0){
    $rg_id = $_GET['id'];
}elseif($_POST['id'] > 0){
    $rg_id = $_POST['id'];
}    
$rgDAO = new dao\RechnungDAO;
$rg = new Rechnung();
$rg = $rgDAO->readSingleInvoice($rg_id);
if($rg->getReise() == ""){
    ErrorController::error404View();
}else{

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
        <script src="https://docraptor.com/docraptor-1.0.0.js"></script>
        <script type="text/javascript">
            function reloadOriginalInvoice(){
                location.reload();
            }
            function printInvoice(){      
                window.open(document.URL+'/printSingleInvoice?rg_id='+rg_id,'_blank');
            }
        </script>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/logout" ?>">Logout</a></li>
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
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("reise").disabled=false'></a></td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="rgart" name="rgart" class="dropdown" style="width:300px;" disabled>
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
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("FileInput").type="file";document.getElementById("FileInput").disabled=false'></a></td>
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