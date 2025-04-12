<?php
require_once 'db.php';
require_once 'Produkt.php';

$id=isset($_POST['id']) ? (int)$_POST['id'] : 0;
// ID==0 ist OK und bedeutet: neues Produkt anlegen

$produktname=isset($_POST['produktname']) ? $_POST['produktname'] : null;
if(empty($produktname)) {
	header('Location:produkt_bearbeiten.php');
	exit;
}
// Zeilenumbrüche normalisieren
$beschreibung=isset($_POST['beschreibung']) ? str_replace("\r","\n",str_replace("\r\n","\n",$_POST['beschreibung'])) : '';
//Leere Produktbeschreibung ist OK

$produkt=Produkt::createInstance($id,$produktname,$beschreibung);
$produkt->speichern();

header('Location:produkt_anzeigen.php?id='.$id);
exit;
?>