<?php
require_once 'db.php';
$staedte=array();
$result=$db->query("select id,stadtname,einwohnerzahl from stadt order by einwohnerzahl desc");
while($stadt=$result->fetch_object()) {
	$staedte[]=$stadt;
}
$result->free();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module">
        import { StadtlisteSeite } from './StadtlisteSeite.js';
        let seite=new StadtlisteSeite(<?= json_encode($staedte) ?>);
        seite.initGUI();
    </script>
</head>
<body>
    
</body>
</html>