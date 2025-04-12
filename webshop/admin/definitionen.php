<?php
// Man würde hier eine Klasse definieren und die .php-Datei genauso wie die Klasse benennen.

function get_int($key,$defaultValue) {
	return isset($_GET[$key]) ? (int)$_GET[$key] : $defaultValue;
}

?>