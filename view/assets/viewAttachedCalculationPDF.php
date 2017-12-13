<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */
use database\Database;

            $pdo = Database::connect();           
            $statement = $pdo->query("SELECT pdf_object FROM rechnung where rg_id = 48");
           // $statement->bindValue(':rg_id', $rg_id);
            $file = "";
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $file .= $row['pdf_object'];
            }

        
//$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
header("Content-type: application/pdf"); 
print pg_unescape_bytea($file);
