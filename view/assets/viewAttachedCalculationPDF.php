<?php
$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
header('Content-type: application/pdf');
echo file_get_contents('data:application/pdf;base64,'.base64_encode($file));