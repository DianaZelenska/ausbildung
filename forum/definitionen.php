<?php
require_once 'db.php';

// Beiträge laden
$beitraege=array();
$beitraegeById=array();

$result = $db->query("SELECT id, autorid, datum, inhalt, parentid FROM beitrag ORDER BY datum DESC");
while ($beitrag = $result->fetch_object()) {
    $beitrag->antworten = array();
    $beitraege[] = $beitrag;
    $beitraegeById[$beitrag->id] = $beitrag;
}
$result->free();

// Antworten zuweisen: Baumstruktur aufbauen
$wurzelBeitraege = array(); // Liste der Wurzelbeiträge (parentid = NULL)

foreach ($beitraege as $beitrag) {
    if (empty($beitrag->parentid)) {
        $wurzelBeitraege[] = $beitrag; // Wurzelbeitrag hinzufügen
    } else {
        // Parent-Beitrag finden und als Antwort hinzufügen
        $parent = $beitraegeById[$beitrag->parentid];
        $parent->antworten[] = $beitrag;
    }
}

// Autoren-Informationen laden und in Map speichern
$autorenById = array();
$result = $db->query("SELECT id, vorname FROM autor");

while ($autor = $result->fetch_object()) {
    $autorenById[$autor->id] = $autor;
}
$result->free();

// Jedem Beitrag das Autor-Objekt zuweisen
foreach ($beitraege as $beitrag) {
    if (isset($autorenById[$beitrag->autorid])) {
        $beitrag->autor = $autorenById[$beitrag->autorid];
    } else {
        $beitrag->autor = null;
    }
}

function beitrag_anzeigen($beitrag) {
    $autorName = $beitrag->autor ? htmlspecialchars($beitrag->autor->vorname) : 'Unbekannt';

    echo "<div class='beitrag'>";
    echo "<strong>" . $autorName . "</strong> <em>(" . htmlspecialchars($beitrag->datum) . ")</em>";
    echo "<p>" . nl2br(htmlspecialchars($beitrag->inhalt)) . "</p>";

    // Antwortformular anzeigen
    echo "<form action='beitrag_speichern.php' method='post'>
            <input type='hidden' name='parentid' value='{$beitrag->id}'>
            <textarea name='inhalt' rows='2' cols='50' placeholder='Antwort schreiben...'></textarea><br>
            <input type='submit' value='Antworten'>
          </form>";
    echo "</div>";


    // Wenn es Antworten gibt, diese anzeigen
    if (!empty($beitrag->antworten)) {
        echo "<div class='antwort'>";
        echo "<h4>Antworten:</h4>";
        foreach ($beitrag->antworten as $antwort) {
            beitrag_anzeigen($antwort); // Rekursiv Antworten anzeigen
        }
        echo "</div>";
        echo "<br />";
    }
}
?>