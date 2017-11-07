<html>
    <body>
        <h1>test maja</h1>
    </body>
</html>

<?php
    use database\Database;

    // Create connection
    $pdo = Database::connect();

    $query = $pdo->query("SELECT beschreibung FROM rechnungsart"); // Run your query
    
    echo "<select>";
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
         echo "<option>".$row['beschreibung']. "</option>";
    }
    echo "</select>";
?>