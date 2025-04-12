<?php
$id=isset($_POST['id']) ? $_POST['id'] : null;
// $id==0 ist OK und bedeutet "neue Stadt hinzufügen", wir werden INSERT anstatt UPDATE machen
$stadtname=isset($_POST['stadtname']) ? $_POST['stadtname'] : null;
if(empty($stadtname)) {
    header('Location: stadt_bearbeiten.php?id='.$id); //. bedeutet "Lonkatenieren", in Java wird + verwendet
    exit;
}
$einwohnerzahl=isset($_POST['einwohnerzahl']) ? (int)$_POST['einwohnerzahl'] : 0;
if($einwohnerzahl<=0) {
    header('Location: stadt_bearbeiten.php?id='.$id);
    exit;
}
require_once 'db.php';
// STRENGST VERBOTEN!!! SQL INJECTION!!!
//$db->query("update stadt set stadtname='$stadtname', einwohnerzahl=$einwohnerzahl where id=$id");

if($id>0) {
// Man benutzt ein PreparedStatement
//Beispiel-Daten im SQL durch ? ersetzen, dann prepare()
$stmt=$db->prepare("update stadt set stadtname=?, einwohnerzahl=? where id=?");
// bind_param() "verpackt" die Daten so, dass sie niemals ausgeführt werden oder die SQL-Syntax stören können
// Sie braucht die Typen der Daten: s für string, i für int, d für float (!!)
$stmt->bind_param('sii',$stadtname,$einwohnerzahl,$id);
// Statement ausführen
$stmt->execute();
// Bei UPDATE bekommt man nichts weiteres
} else { // keine korrekte ID -> INSERT
    $stmt=$db->prepare("insert into stadt(stadtname, einwohnerzahl) values(?,?)");
    $stmt->bind_param('si',$stadtname,$einwohnerzahl);                
    $stmt->execute(); 
    //Bei INSERT bekommt man die auto_increment ID
	// Die brauchen wir hier nicht
	//$id=$db->insert_id;   
}
// Ein Script, das speichert oder löscht, sollte keine Anzeige machen,
// damit es nicht neu geladen werden kann (Neuladen würde die Speicherung wiederholen)
// => immer zu einer View weiterleiten
header('Location: index.php');
exit;
?>
