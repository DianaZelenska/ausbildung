<?php
// Bilder-Ordner auslesen
$dateien=array(); //Liste vorbereiten
$d=opendir('bilder'); //Pfad auf der Festplatte (mit \), keine URL (mit /)
while($f=readdir($d)) {
    if($f=='.' || $f=='..') continue; //Konventionelle Ordner . und .. ignorieren
    $dateien[]=$f; //gelesenen Dateinamen $f in die Liste hinzufügen
}
closedir($d);

// Liste sortieren
sort($dateien);

//Debug-Ausgabe
//var_dump($dateien);
//exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bildergalerie</title>
    <style>
        img {
            max-height:150px;
        }
    </style>
</head>
<body>
    <h1>Bildergalerie</h1> 
    
    <form action="upload.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <input type="file" name="bild" />
    <input type="submit" value="Hochladen">
    </form>
    <?php
    foreach($dateien as $f) {
    ?>
    <img src="bilder/<?= htmlspecialchars($f,ENT_QUOTES) ?>" />
    <?php
    }
    ?>
</body>
</html>