<?php
require_once 'db.php';

// Daten laden
$mitglieder=array();
$result=$db->query("select * from Mitglied");
while($mitglied=$result->fetch_object()){
  $mitglieder[]=$mitglied;
}
$result->free();
echo json_encode($mitglieder);
?>