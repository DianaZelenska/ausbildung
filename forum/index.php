<?php
@session_start();

require_once 'db.php';
require_once 'definitionen.php';

// Autoren mit gesammelten IDs laden
if (!empty($autorenById)) {
    $result = $db->query("SELECT id, vorname FROM autor WHERE id IN (" . implode(",", array_keys($autorenById)) . ")");
    
    while ($autor = $result->fetch_object()) {
        // Autor in die Map ID => Objekt speichern
        $autorenById[$autor->id] = $autor;
    }
    $result->free();
}

$beitraegeById = array();

// Jedem Beitrag seinen Autor zuweisen
foreach ($beitraege as $beitrag) {
    $beitrag->autor = $autorenById[$beitrag->autorid];
}

// Prüfen, ob Autor in der Session existiert
$eingeloggt=isset($_SESSION['autor']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Startseite</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<?php
  if(!$eingeloggt) {
?>
  <a href="loginformular.php">Login</a>
<?php
  } else {
?>
<h2>Hallo, <?= htmlspecialchars($_SESSION['autor']->vorname) ?>!</h2>
<h2>Neuen Beitrag schreiben</h2>
<form action="beitrag_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<textarea name="inhalt" id="inhalt" rows="5" cols="40"></textarea><br />
<input type="submit" value="Speichern" /><br />
</form>
<br />
<a href="logout.php">Logout</a><br />
<br />
<a href="loginformular.php">Als einen anderen Autor einloggen</a><br />
<?php
  }
?>

    <h1>Neueste Beiträge</h1>

<?php
foreach($wurzelBeitraege as $beitrag) {
  beitrag_anzeigen($beitrag);
  echo "<br />";
}
?>
</body>
</html>