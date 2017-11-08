<?php
use database\Database;

/*
 * View, um eine neue Rechnung zu erfassen
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Verwaltung der Reisen</title>
    </head>
    <body>
        <div id="whiteblock">
            <div id="block">
                <div id="blockleft">
                    <h3>neue Rechnung</h3>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <table>
                            <tr>
                                <td>Reise</td>
                                    <select name="reise">
                                    <?php 
                                    $pdo = Database::connect();
                                    $query = $pdo->query("SELECT reise_id, beschreibung FROM reise order by beschreibung asc");

                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                         echo "<option value='".$row['reise_id']."'>".$row['beschreibung'].", ".$row['reise_id']."</option>";
                                    }

                                    ?>
                                    </select>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select name="rgart">
                                    <?php 
                                    $pdo = Database::connect();
                                    $query = $pdo->query("SELECT beschreibung FROM rechnungsart order by beschreibung asc");

                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                         echo "<option value='".$row['beschreibung']."'>".$row['beschreibung']."</option>";
                                    }

                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kosten</td>
                                <td><input type="text" name="kosten" value="" /><br/></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><input type="text" name="beschreibung" value="" /><br/></td>
                            </tr>
                            <tr>
                                <td>Dokument</td>
                                <td><input type="text" name="dokument" value="" /><br/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="hinzuf&uuml;gen" name="subneuerechnung" /> <input type="reset" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
