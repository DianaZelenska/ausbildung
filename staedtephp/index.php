<?php
//Daten laden
//DB-Verbindung mit dem entsprechenden Script öffnen
require_once 'db.php';
//Liste für die Datensätze vorbereiten
$staedte=array();
// SQL-Anfrage an DB schicken, mit SELECT bekommt man einen ResultSet, aus dem man die Datensätze lesen kann
$result=$db->query("select id,stadtname,einwohnerzahl from stadt order by einwohnerzahl desc");
//Datensätze lesen, bis man false bekommt
while($stadt=$result->fetch_object()) {
	//den gelesenen Datensatz in die Liste hinzufügen
	$staedte[]=$stadt;
}
// ResultSet schließen, damit die Tabelle wieder frei ist
$result->free();
// Man muss alles schließen, was man geöffnet hat
// AUSSER in PHP die Datenbankverbindung
// Also, hier kein $db->close();

//Debug-Ausgabe
//var_dump($staedte);
//exit;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Städte - Startseite</title>
  <script>
    //TODO auch den Namen der Stadt geben, damit die Warnung lesbarer ist
    function stadt_loeschen(id) {
      if (confirm('Stadt mit der ID='+id+' löschen, sicher?')) {
        location.href='stadt_loeschen.php?id='+id;
      }
    }
  </script>
</head>
<body>
<h1>Städte - Startseite</h1>

<a href="stadt_bearbeiten.php?id=0">Neue Stadt hinzufügen</a><br />
<br />

<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th>ID</th>
	<th>Stadtname</th>
	<th>Einwohnerzahl</th>
  <th></th>
  <th></th>
  <th></th>
  </tr>
<?php
// Daten anzeigen
foreach($staedte as $stadt) {
?>
  <tr>
    <td><?= $stadt->id ?></td>
	<td><?= $stadt->stadtname ?></td>
	<td><?= $stadt->einwohnerzahl ?></td>
  <td><a href="stadt_anzeigen.php?id=<?= htmlspecialchars($stadt->id,ENT_QUOTES) ?>">Anzeigen</a></td>
  <td><a href="stadt_bearbeiten.php?id=<?= htmlspecialchars($stadt->id,ENT_QUOTES) ?>">Bearbeiten</a></td>
  <td><a href="javascript:stadt_loeschen(<?= htmlspecialchars($stadt->id,ENT_QUOTES) ?>)">Löschen</a></td>
</tr>
<?php
}
?>
</table>
<br />
<a href="export_json.php">Daten als JSON exportieren</a>
<a href="export_csv.php">Daten als CSV exportieren</a>
</body>
</html>