<?php
use database\Database;

    // Create connection
    $pdo = Database::connect();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Verwaltung der Reisen</title>
    </head>
    <body>
        <h3>neue Rechnung</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <table>
                <tr>
                    <td>Reise</td>
                    <td><input type="text" name="reise" value="" /><br/></td>
                </tr>
                <tr>
                    <td>Rechnungsart</td>
                    <td>
                        <select name="owner">
                            <?php 
                            $query = $pdo->query("SELECT beschreibung FROM rechnungsart"); // Run your query
                            echo "testmaja";
                            echo '<select name="rgart">'; // Open your drop down box
                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                 echo '<option value="'.$row['beschreibung'].'"></option>';
                            }
                            
                            ?>
                        </select>
                    <br/></td>
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
                    <td></td>
                    <td><input type="submit" value="hinzuf&uuml;gen" name="subneuerechnung" /> <input type="reset" value="zur&uuml;cksetzen" /></td>
                </tr>
            </table>
        </form>
        <br/>
    </body>
</html>

<?php
    Database::close();
?>