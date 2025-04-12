<?php
require_once 'db.php';
require_once 'definitionen.php';
require_once 'Produkt.php';

$id=get_int('id',0);
$produkt=Produkt::produkt_laden($id);

if(!$produkt) {
  //nicht gefunden: Produkt-Objekt mit leeren Feldern erstellen
  $produkt=Produkt::createInstance(0,'','');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Neues Produkt</title>
</head>
<body>
<h1>Webshop - Neues Produkt</h1>
<form action="produkt_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<input type="hidden" name="id" value="<?= htmlspecialchars($produkt->id,ENT_QUOTES) ?>" />
	<label for="produktname">Produktname:</label><br />
	<input type="text" id="produktname" name="produktname" style="width:300px;" value="<?= htmlspecialchars($produkt->produktname,ENT_QUOTES) ?>" /><br />
	<label for="beschreibung">Beschreibung:</label><br />
	<textarea id="beschreibung" name="beschreibung" style="width:300px;height:300px;"><?= $produkt->beschreibung ?></textarea><br />
	<input type="submit" value="Speichern" /> <a href="index.php">Abbrechen</a>
</form>
</body>
</html>