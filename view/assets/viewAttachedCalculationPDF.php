<?php
$pdo = Database::connect();           
$statement = $pdo->prepare("SELECT pdf_object FROM rechnung where rg_id = :rg_id");
$statement->bindValue(':rg_id', $rg_id);
$statement->execute();
foreach($row as $result){
     $file=$result['pdf'];
}
header('Content-type: application/pdf');
echo file_get_contents('data:application/pdf;base64,'.base64_encode($file));