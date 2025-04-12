<?php
require_once 'db.php';

// Daten laden
$staedte=array();
$result=$db->query("select id,stadtname, einwohnerzahl from stadt order by einwohnerzahl desc");
while($stadt=$result->fetch_object()) {
    $staedte[]=$stadt;
}
$result->free();

//Headers, die sagen
// "Hier kommt kein HTML, sondern JSON" MIME-Type vom JSON-Format: application...
header('Content-Type:application/json; charset=UTF-8');
// "Bitte dieses Dokument nicht anzeigen, sondern zum Download geben"
header('Content-Disposition:attachment; filename=staedte.json');
//Daten Daten schicken
echo json_encode($staedte);
?>