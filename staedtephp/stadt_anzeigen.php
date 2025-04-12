<?php
// EVA-Eingabe
// ID der anzuzeigenen Stadt aus der URL lesen
// URL-Parameter findet man im globalen assoziativen Array (Map) $_GET
// Hier müssen wir prüfen, ob die URL wirklich die erwartete ID enthält
// und zwar mit dem gewünschten Key 'id'.
// Wenn dieser Key nicht gesetzt ist (keine ID in der URL), nehmen wir
// als Platzhalter ID=0, weil wir sicher sind, dass es keine Stadt erreicht.
// URL-Parameter sind strings, in diesem Fall muss ich die ID zu einem int konvertieren
// Wenn das String keine Zahl darstellt, bekommen wir 0
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Datensatz der stadt laden
// DB-Verbidung öffnen, man bekommt die Variable $db
require_once 'db.php';
// Provisorisch bauen wir die gesuchte ID ins SQL-ein
$result=$db->query("select id, stadtname, einwohnerzahl from stadt where id=$id");
// Falls nicht vorhanden (z.Bl falls $id==0), bekommen wir FALSE.
$stadt=$result->fetch_object();
$result->free();
// Prüfen, ob man wirklich einen Datensatz bekommen hat
if(!$stadt) {
    // Umleitung
    header('Location: index.php');
    exit;
}
// Stadt anzeigen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stadt</title>
</head>
<body>
    <h1>Stadt <?= $stadt->stadtname ?></h1>
    ID: <?= $stadt->id ?><br />
    Stadtname: <?= $stadt->stadtname ?><br />
    Einwohnerzahl: <?= $stadt->einwohnerzahl ?><br /> 
    <a href="index.php">Zurück zur Liste</a>  
</body>
</html>