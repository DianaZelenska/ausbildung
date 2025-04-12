<?php
// Diese Datei sollte gelöscht werden, sobald man sich das Passwort gemerkt hat
// Das Ergebnis der Verschlüsselung wird in .htpasswd hinter dem Nutzernamen geschrieben
echo password_hash('Einstein',PASSWORD_DEFAULT);
?>