<?php

use database\Database;
use service\Service;

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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neue Rechnung hinzufügen</td>
                        </tr>
                    </table>
                    <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/neu" method="POST" enctype="multipart/form-data">
			<table>
                            <tr>
                                <td>Reise</td>
				<td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach(Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                            echo "<option value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
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
                                        // Abfrage für Rechnungsarten
                                        foreach(Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                            echo "<option value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                        }
                                        
                                        ?>
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <td>Kosten</td>
                            <td><input type="text" name="kosten" style="width:296px;"/></td>
                        </tr>
                        <tr>
                            <td>Beschreibung</td>
                            <td><textarea name="beschreibung" rows="5" cols="35"></textarea></td>
                        </tr>
                        <tr>
                            <td>Dokument</td>
                            <td>
                                <input id="dokument" type="file" name="dokument" accept="application/pdf" style="width:300px;"/>
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