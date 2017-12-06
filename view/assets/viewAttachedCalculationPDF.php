<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */

$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);

?>
<html>
<object data="data:application/pdf;base64,<?php echo base64_encode($file) ?>" type="application/pdf" style="height:200px;width:60%"></object>
</html>