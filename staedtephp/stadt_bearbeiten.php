<?php
require_once 'db.php';

$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result=$db->query("select id, stadtname, einwohnerzahl from stadt where id=$id");

$stadt=$result->fetch_object();
$result->free();

//if(!$stadt) {
    // OK, der Nutzer will eine neue Stadt hinzufügen
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $stadt ? "Stadt ".$stadt->stadtname." bearbeiten" : "Neue Stadt anlegen" ?></title>
</head>
<body>
    <h1><?= $stadt ? "Stadt ".$stadt->stadtname." bearbeiten" : "Neue Stadt anlegen" ?></h1>
    <form action="stadt_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
      <input type="hidden" name="id" value="<?= $stadt ? htmlspecialchars($stadt->id,ENT_QUOTES) : 0 ?>" />
    <table border="1" cellspacing="0" style="border-collapse:collapse;">
    <tr>
    <th>ID</th>
    <td><?= $stadt ? $stadt->id : "(ID wird beim Speichern generiert)" ?></td>
  </tr>
  <tr>
    <th>Stadtname</th>
    <td><input type="text" name="stadtname" value="<?= $stadt ? htmlspecialchars($stadt->stadtname,ENT_QUOTES) : "" ?>" style="width:150px;" /></td>
  </tr>
  <tr>
    <th>Einwohnerzahl</th>
    <td><input type="number" name="einwohnerzahl" value="<?= $stadt ? htmlspecialchars($stadt->einwohnerzahl,ENT_QUOTES) : "" ?>" /></td>
  </tr>
  <tr>
    <th></th>
    <td>
      <input type="submit" value="Speichern" />
      <a href="index.php">Abbrechen</a>
    </td>
  </tr>
</table>    
</form>    
</body>
</html>

