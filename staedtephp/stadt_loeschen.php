<?php
require_once 'db.php';

$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt=$db->prepare("delete from stadt where id=?");
$stmt->bind_param('i',$id);                
$stmt->execute();

header('Location: index.php');
exit;
    ?>
