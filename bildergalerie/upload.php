<?php
if(isset($_FILES['bild']) && file_exists($_FILES['bild']['tmp_name'])) {
    //TODO prüfen, ob $_FILES['bild']['tmp_name'] wirklich ein Bild enthält
    $orig=$_FILES['bild']['name'];
    //TODO schauen, ob die Ziel-Datei schon vorhanden ist, und den Fall behandeln
    // if(file_exists('bilder/'.$orig)) { ... }
    if(move_uploaded_file($_FILES['bild']['tmp_name'],'bilder/'.$orig)) {
        // Temp_Datei wurde zum Ziel kopiert
        // Linux-Zugriffsrechte setzen (sichtbar für die ganze Welt)
        chmod('bilder/'.$orig,0644);
    }
}

header('Location: index.php');
exit;
?>