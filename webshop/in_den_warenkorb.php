<?php
@session_start();
require_once 'db.php';

$produktid=isset($_GET['produktid']) ? (int)$_GET['produktid'] : 0;

if(isset($_COOKIE['warenkorb'])) {
	// Falls Warenkorb schon im Cookie (als string), ihn dekodieren
	$warenkorb=(array)json_decode($_COOKIE['warenkorb']);
} else {
	// sonst neue, leere Map anlegen
	$warenkorb=array();
}

if(isset($warenkorb[$produktid])) { 
	// falls Produkt schon im Warenkorb (Produkt-ID als Key im Warenkorb vorhanden)
	// dann Anzahl im entsprechenden Objekt vom Warenkorb hochzählen
	$warenkorb[$produktid]->anzahl++;
	// und neuen Wert als Cookie speichern
	setcookie('warenkorb',json_encode($warenkorb),0); // Warenkorb soll für immer im Cookie bleiben
	
	header('Location: warenkorb.php');
	exit;
}

// Produkt noch nicht im Warenkorb: es aus der DB laden
$stmt=$db->prepare("select id,produktname from produkt where id=? limit 1");
$stmt->bind_param('i',$produktid);
$stmt->execute();
$result=$stmt->get_result();
$produkt=$result->fetch_object();
$result->free();
if(!$produkt) { // Produkt nicht gefunden => zurück zur Liste
	header('Location: index.php');
	exit;
}
// Gefunden! Produkt in den Warenkorb hinzufügen, und zwar mit Anzahl=1 und assoziiert mit seiner ID
$produkt->anzahl=1;
// Produkt mit seiner ID assoziieren
$warenkorb[$produkt->id]=$produkt;
// und neuen Wert als Cookie speichern
setcookie('warenkorb',json_encode($warenkorb),0); // Warenkorb soll für immer im Cookie bleiben (kein Zeitlimit)

header('Location: warenkorb.php');
exit;
?>