<?php
@session_start();

require_once 'db.php';

$autorid=isset($_GET['autorid']) ? (int)$_GET['autorid'] : null;

if($autorid <= 0) {
    header('Location: loginformular.php');
    exit;
}

$stmt=$db->prepare("select id,vorname from autor where id=? limit 1");
$stmt->bind_param('i',$autorid);                
$stmt->execute();
$result=$stmt->get_result();

if($autor=$result->fetch_object()) {
    $_SESSION['autor']=$autor;

    header('Location: index.php');
    exit;
} else {
    header('Location: loginformular.php');
    exit;
}

$result->free();
?>