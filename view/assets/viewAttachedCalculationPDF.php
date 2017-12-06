<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */


            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT pdf_object FROM rechnung where rg_id = 38");
           // $statement->bindValue(':rg_id', $rg_id);
            $statement->execute();
            foreach($statement as $result){
                $file= pg_unescape_bytea($result['pdf_object']);
            }
        
//$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
header("Content-type: application/pdf"); 
print $file;  