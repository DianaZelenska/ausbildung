<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id<=0) {
	echo 'Falsche ID';
	exit;
}
$alter=isset($_GET['alter']) ? (int)$_GET['alter'] : 0;
if($alter < 6) {
	header('Location: index.php');
	exit;
}

$stmt=$db->prepare("update Mitglied set jahre=? where id=? limit 1");
$stmt->bind_param('ii',$alter,$id);
$stmt->execute();
echo 'OK';
exit;
?>