<?php
require_once 'db.php';
require_once 'definitionen.php';
require_once 'Produkt.php'; // Wenn wir mit Modulen arbeiten würden, wäre hier ein Import der Klasse Produkt aus dem entsprechenden Modul.

$id=get_int('id',0);
// Mit :: erreichen wir ein static, hier eine statische Methode.
$produkt=Produkt::produkt_laden($id);

if(!$produkt) {
  //nicht gefunden
  header('Location:index.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Produkt: <?= $produkt->produktname ?></title>
</head>
<body>
<h1><?= $produkt->produktname ?></h1>
<div class="beschreibung"><?= nl2br($produkt->beschreibung) ?></div>
<a href="index.php">Zur Liste</a>
</body>
</html>