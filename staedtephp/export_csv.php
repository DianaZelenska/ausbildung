<?php
require_once 'db.php';

$staedte=array();
$result=$db->query("select id,stadtname,einwohnerzahl from stadt order by einwohnerzahl desc");
// Wir holen hier die Datensätze als AssoziativeArrays, weil
// ...
//...
while($stadt=$result->fetch_assoc()) {
    $staedte[]=$stadt;
}
$result->free();

header('Content-Type:application/csv; charset=UTF-8');
header('Content-Disposition:attachment; filename=staedte.csv');

// echo json_encode($staedte); gibt es nicht

// Output zum Browser als Stream öffnen
$out = fopen('php://output', 'w');
// Ins Stream schreiben
fprintf($out, "id;stadtname;einwohnerzahl\n");
foreach($staedte as $stadt) {
    fputcsv($out,$stadt,";");
}
fclose($out);
?>