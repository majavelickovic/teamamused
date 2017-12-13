<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */
        
$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
header("Content-type: application/pdf"); 
print pg_unescape_bytea($file);
