<?php
use database\Database;

    // Create connection
    $pdo = Database::connect();

    $query = $pdo->query("SELECT beschreibung FROM rechnungsart"); // Run your query
    echo '<select name="rgart">'; // Open your drop down box
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
         echo "wert: ".$row['beschreibung']. "<br>";
    }

    Database::close();
?>