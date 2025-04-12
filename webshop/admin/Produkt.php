<?php
/**
 * Model-Klasse für die Entität Produkt (DB-Tabelle produkt)
 */
class Produkt {
	/*
	// Variablendefinitionen sind möglich aber nicht wirklich nötig, solange der Konstruktor sie initialisiert
	var $id;
	var $produktname;
	var $beschreibung;
	*/
	
	/* Dies wäre der Konstruktor, um Instanzen dieser Klasse aus einzelnen Datenstücken zu erstellen
	 * Wir wollen aber Instanzen aus der DB laden und dabei automatisch erstellen.
	// Der Konstruktor bekommt Werte als Parameter und speichert sie in die Variablen der Instanz, die er erstellt
	function __construct($id,$produktname,$beschreibung) {
		//$this ist das Objekt, wo man gerade ist
		$this->id=$id;
		$this->produktname=$produktname;
		$this->beschreibung=$beschreibung;
	}
	*/
	
	// Dies ist der Konstruktor ohne Parameter, um Instanzen automatisch erstellen zu lassen.
	// Sie haben dann automatisch Variablen, die den Datenbankspalten entsprechen.
	function __construct() {
		// Hier keine Initialisierung
	}
	// FactoryFunction, um den Konstruktor mit Daten zu ersetzen
	static function createInstance($id,$produktname,$beschreibung) {
		$p=new Produkt();
		$p->id=$id;
		$p->produktname=$produktname;
		$p->beschreibung=$beschreibung;
		return $p;
	}
	
	static function alle_laden() {
		global $db;
		$alle=array();
		$result=$db->query("select id,produktname from produkt order by id desc limit 10");
		while($produkt=$result->fetch_object('Produkt')){
		  $alle[]=$produkt;
		}
		$result->free();
		return $alle;
	}
	
	static function produkt_laden($id) {
		// globale Variablen in die Funktion reinholen
		global $db;
		// $stmt und $geladenes sind hier lokal und außerhalb der Funktion nicht sichtbar
		$stmt=$db->prepare("select id,produktname,beschreibung from produkt where id=? limit 1");
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$geladenes=$result->fetch_object('Produkt'); //fetch_object() bekommt den Namen einer Klasse und erstellt Instanzen dieser Klasse
		$result->free();
		return $geladenes;
	}
	
	function speichern() {
		global $db;
		if($this->id<=0) {
			$stmt=$db->prepare("INSERT INTO `produkt` (`id`, `produktname`, `beschreibung`) VALUES (NULL, ?, ?)");
			$stmt->bind_param('ss',$this->produktname,$this->beschreibung);
			$stmt->execute();
			$this->id=$db->insert_id;
		} else {
			$stmt=$db->prepare("UPDATE `produkt` SET `produktname` = ?, `beschreibung` = ? WHERE `produkt`.`id` = ? limit 1");
			$stmt->bind_param('ssi',$this->produktname,$this->beschreibung,$this->id);
			$stmt->execute();
		}
	}
}
?>