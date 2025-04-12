<?php
require_once 'db.php';

$autoren=array();
$result = $db->query("SELECT id, vorname FROM autor order by vorname");
while($autor=$result->fetch_object()) {
  
    $autoren[]=$autor;
  }
  $result->free();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
  <h1>Login</h1> 
  <ul>
    <?php
        foreach($autoren as $autor) {
    ?>
    <li>
    <a href="login.php?autorid=<?= $autor->id ?>">Login As</a>
        <?= htmlspecialchars($autor->vorname,ENT_QUOTES) ?>
    </li>
    <?php
        }
    ?>
  </ul> 
</body>
</html>