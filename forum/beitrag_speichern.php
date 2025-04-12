<?php
@session_start();

require_once 'db.php';

if(!isset($_SESSION['autor'])) {
    header('Location: index.php');
    exit;
}

// Autor-Objekt aus der Session holen
$autor=$_SESSION['autor'];

$inhalt=isset($_POST['inhalt']) ? str_replace("\r","\n",str_replace("\r\n","\n",$_POST['inhalt'])) : '';
$parentid = isset($_POST['parentid']) ? intval($_POST['parentid']) : null;

if (empty($inhalt)) {
    header('Location: index.php');
    exit;
}

// Neuen Beitrag in die Datenbank speichern
$stmt = $db->prepare("INSERT INTO beitrag (autorid, datum, inhalt, parentid) VALUES (?, NOW(), ?, ?)");
$stmt->bind_param('isi', $autor->id, $inhalt, $parentid); // ID des Autors und Inhalt binden
$stmt->execute();

header('Location: index.php');
exit;
?>
