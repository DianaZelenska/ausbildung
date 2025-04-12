<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id<=0) {
	echo 'Falsche ID';
	exit;
}
$vorname=isset($_GET['vorname']) ? $_GET['vorname'] : null;
if(empty($vorname)) {
	echo 'Falscher Vorname';
	exit;
}

$stmt=$db->prepare("update Mitglied set vorname=? where id=? limit 1");
$stmt->bind_param('si',$vorname,$id);
$stmt->execute();
echo 'OK';
exit;
?>