<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */
use database\Database;

            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT encode(pdf_object::bytea, 'escape') FROM rechnung where rg_id = 48");
           // $statement->bindValue(':rg_id', $rg_id);
            $statement->execute();
            $file = $statement->fetchAll();

        
//$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
//header("Content-type: application/pdf"); 
            $pdfstring = "";
            foreach($file as $string){
                $pdfstring .= $string;
            }
//echo pg_unescape_bytea($file);  
            echo "test1";
echo $pdfstring;
echo "test2";