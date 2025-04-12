<?php
require_once 'db.php';

$angebote=array();
$result=$db->query("select id,produktname from produkt");
while($produkt=$result->fetch_object()){
  $angebote[]=$produkt;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop</title>
</head>
<body>
<h1>Webshop</h1>
<h2>Im Angebot:</h2>
<a href="warenkorb.php">Zum Warenkorb</a><br />
<br />
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th>ID</th>
	<th>Produktname</th>
	<th></th>
  </tr>
<?php
foreach($angebote as $produkt) {
?>
  <tr>
    <td><?= $produkt->id ?></td>
	<td><?= $produkt->produktname ?></td>
	<td><a href="in_den_warenkorb.php?produktid=<?= htmlspecialchars($produkt->id,ENT_QUOTES) ?>">In den Warenkorb</a></td>
  </tr>
<?php
}
?>
</table>
</body>
</html>