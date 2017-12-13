<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */

//PDf aus DB lesen
$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);

//PDF anzeigen
header("Content-type: application/pdf"); 
print pg_unescape_bytea($file);

