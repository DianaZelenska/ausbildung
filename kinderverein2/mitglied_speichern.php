<?php
require_once 'db.php';

// Der Nutzer kann immer dieses Script ohne Daten abrufen, 
// oder mit Daten aber ohne unser Formular:
// Die Eingaben müssen hier unbedingt geprüft werden.

$vorname=isset($_POST['vorname']) ? $_POST['vorname'] : null;
if(empty($vorname)) {
	// Normalerweise sind die Daten schon von JS geprüft.
	// Falls wir noch hier falsche bekommen, heißt es, dass der Nutzer
	// versucht hat, zu hacken. Dann hat er Pech: zurück zur Starseite, 
	// ohne Formular und ohne Fehlermeldung.
	header('Location: index.php');
	exit;
}

$nachname=isset($_POST['nachname']) ? $_POST['nachname'] : null;
if(empty($nachname)) {
	header('Location: index.php');
	exit;
}

$alter=isset($_POST['alter']) ? (int)$_POST['alter'] : 0;
if($alter < 6) {
	header('Location: index.php');
	exit;
}

$stmt=$db->prepare("insert into Mitglied(vorname,nachname,jahre) values(?,?,?)");
$stmt->bind_param('ssi',$vorname,$nachname,$alter);
$stmt->execute();
header('Location: index.php');
exit;
?>
