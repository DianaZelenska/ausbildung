<?php
@session_start();

if(isset($_COOKIE['warenkorb'])) {
	// Falls Warenkorb schon im Cookie vorhanden, ihn dekodieren
	$warenkorb=(array)json_decode($_COOKIE['warenkorb']);
} else {
	// Falls noch kein Warenkorb: leere Map erstellen
	$warenkorb=array();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Warenkorb</title>
</head>
<body>
<h1>Webshop - Warenkorb</h1>
<?php
if(empty($warenkorb)) {
?>
Ihr Warenkorb ist noch leer.
<?php
} else {
?>
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th>ID</th>
	<th>Produktnamen</th>
	<th>Anzahl</th>
  </tr>
<?php
	foreach($warenkorb as $produktid => $produkt) {
?>
  <tr>
    <td><?= $produkt->id ?></td>
	<td><?= $produkt->produktname ?></td>
	<td><?= $produkt->anzahl ?></td>
  </tr>
<?php
	}
?>
</table>
<?php
}
?>
<a href="index.php">Zur Startseite</a>
</body>
</html>