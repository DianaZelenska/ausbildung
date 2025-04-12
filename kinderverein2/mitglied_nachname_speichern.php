<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id<=0) {
	echo 'Falsche ID';
	exit;
}
$nachname=isset($_GET['nachname']) ? $_GET['nachname'] : null;
if(empty($nachname)) {
	echo 'Falscher Vorname';
	exit;
}

$stmt=$db->prepare("update Mitglied set nachname=? where id=? limit 1");
$stmt->bind_param('si',$nachname,$id);
$stmt->execute();
echo 'OK';
exit;
?>