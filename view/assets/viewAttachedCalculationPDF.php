<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */
        
use database\Database;
            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT encode(pdf_object::bytea, 'escape') FROM rechnung where rg_id = 49^8");
            //$statement->bindValue(':rg_id', $rg_id);
            $statement->execute();
            $file = "";
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $file .= str_replace("''", "'", row['encode']);
            }
 
//$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
//header("Content-type: application/pdf"); 
echo $file;

