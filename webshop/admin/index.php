<?php
require_once 'db.php';
require_once 'Produkt.php';

$produkte=Produkt::alle_laden();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Adminbereich</title>
</head>
<body>
<h1>Webshop - Adminbereich</h1>
<a href="produkt_bearbeiten.php">Neues Produkt</a><br />
<br />
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th>ID</th>
	<th>Produktname</th>
	<th></th>
  </tr>
<?php
foreach($produkte as $produkt) {
?>
  <tr>
    <td><?= $produkt->id ?></td>
	<td><a href="produkt_anzeigen.php?id=<?= htmlspecialchars($produkt->id,ENT_QUOTES) ?>"><?= $produkt->produktname ?></a></td>
	<td><a href="produkt_bearbeiten.php?id=<?= htmlspecialchars($produkt->id,ENT_QUOTES) ?>">Bearbeiten</a></td>
  </tr>
<?php
}
?>
</table>
</body>
</html>