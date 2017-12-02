<?php

use database\Database;

/*
 * View, um eine besthende Rechnung zu suchen
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
        <script type="text/javascript">
            //Tabelleninhalt anzeigen, sobald nach Rechnungen gesucht wird
            function refreshTable() {
                var req = new XMLHttpRequest();
                req.open('POST', '/readInvoiceTable');

                req.onreadystatechange = function() {
                    if(req.readyState==4 && req.status==200) {
                        document.getElementById("editableContentTable").innerHTML = tablecontent;
                    }
                }
                req.send(null);
                                        <?php
                            
                        ?>
                
            }
            //Bild zum Rechnung löschen wurde angeklickt, wenn der Benutzer bestätigt, wird die Rechnung gelöscht und die Ansicht aktualisiert
            function deleteInvoice(rg_id){
                if(confirm("Wollen Sie die Rechnung wirklich löschen?")){
                    var req = new XMLHttpRequest();
                    req.open('GET', '/deleteInvoice?del_rg_id='+rg_id);

                    req.onreadystatechange = function() {
                        if(req.readyState==4 && req.status==200) {
                            alert("Die Rechnung " + rg_id + " wurde gelöscht.");
                            refreshTable();
                        }
                    }
                    req.send(null);
                }else{
                    //nichts tun, wenn der Benutzer die Rechnung nicht löschen möchte
                }
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
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                        </tr>
                    </table>
                    <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/bestehend" method="POST">
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
                                <td><input type="text" name="rg_id" style="width:296px;" value="<?php echo $_POST['rg_id']?>"/></td>
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
                                <td colspan="2" align="center"><input type="button" class="button" value="suchen" onclick="refreshTable()"/>  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="blockright">
                    <table id="rgTable">
                        <tr>
                            <th>Rechnungs-ID</th>
                            <th>Reise-ID</th>
                            <th>Rechnungsart</th>
                            <th>Kosten</th>
                            <th></th>
                            <th></th>
                        </tr><div id="editableContentTable"></div>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

