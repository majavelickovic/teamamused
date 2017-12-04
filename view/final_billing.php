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
        <title>Schlussabrechnung anzeigen</title>
        <script type="text/javascript">
            //Seite aktualisieren, damit die Tabelle aktualisiert angzeigt wird
            function refreshTable() {
                document.getElementById("searchForm").submit();
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
                            <td><img src="../design/pictures/search.png"></td><td>Schlussabrechnung anzeigen f&uuml;r eine Reise</td>
                        </tr>
                    </table>
                    <form id="searchForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/schlussabrechnung" method="POST">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                            $pdo = Database::connect();
                                            $query = $pdo->query("SELECT reise_id, beschreibung FROM reise order by beschreibung asc");

                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                if($_POST['reise'] == $row['reise_id']){
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
                                <td colspan="2" align="center"><input type="submit" class="button" value="drucken" />
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

