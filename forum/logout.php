<?php
@session_start();

if(isset($_SESSION['autor'])) {
    unset($_SESSION['autor']);
}

header('Location: index.php');
exit;
?>