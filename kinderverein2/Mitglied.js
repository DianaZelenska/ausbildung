export class Mitglied {
	// Deklaration der Member-Variablen wäre möglich,
	// ist aber nicht nötig, weil sie sowieso im Konstruktor initialisiert werden.
	// var id;
	// var vorname;
	// var nachname;
	// var alter;
	
	constructor(id,vorname,nachname,alter) {
		// Die Werte für diese Variablen werden dem Konstruktor als Parameter gegeben
		this.id=id;
		this.vorname=vorname;
		this.nachname=nachname;
		this.alter=alter;
		// Das wäre eine Member-Variable, für die der Konstruktor selber den Wert findet, ohne Parameter
		// this.erstelltAm=new Date();
	}
	
	setVorname(neuerVorname,anzeigeFunktion) {
		const request = new XMLHttpRequest();
		let url="mitglied_vorname_speichern.php?id="+this.id+"&vorname="+encodeURIComponent(neuerVorname);
		request.open("GET", url, true);
		request.onload = function() {
		  if (request.status >= 200 && request.status < 300) {
			if(request.responseText=='OK') {
				// Die onload-Funktion wird im Kontext des request-Objekts ausgeführt.
				// D.h. hier würde "this" das request-Objekt erreichen, und nicht das Mitglied-Objekt.
				// Um dies zu korrigieren, benutzen wir bind(), siehe unten.
				// Alternativ könnte man ins request-Objekt merken, welches Mitglied es betrifft.
				this.vorname=neuerVorname;
				anzeigeFunktion();
			} else {
				alert("Der Server antwortete: ", request.responseText);
			}
		  } else {
			alert("Error: "+request.status, request.statusText);
		  }
		}.bind(this); // hier sind wird außerhalb der onload-Funktion, "this" erreicht das Mitglied-Objekt.
		// wir binden die onload-Funktion damit, sodass "this" in der onload-Funktion das Mitglied-Objekt erreicht.
		request.send();
	}

	setNachname(neuerNachname,anzeigeFunktion) {
		const request = new XMLHttpRequest();
		let url="mitglied_nachname_speichern.php?id="+this.id+"&nachname="+encodeURIComponent(neuerNachname);
		request.open("GET", url, true);
		request.onload = function() {
		  if (request.status >= 200 && request.status < 300) {
			if(request.responseText=='OK') {
				// Die onload-Funktion wird im Kontext des request-Objekts ausgeführt.
				// D.h. hier würde "this" das request-Objekt erreichen, und nicht das Mitglied-Objekt.
				// Um dies zu korrigieren, benutzen wir bind(), siehe unten.
				// Alternativ könnte man ins request-Objekt merken, welches Mitglied es betrifft.
				this.nachname=neuerNachname;
				anzeigeFunktion();
			} else {
				alert("Der Server antwortete: ", request.responseText);
			}
		  } else {
			alert("Error: "+request.status, request.statusText);
		  }
		}.bind(this); // hier sind wird außerhalb der onload-Funktion, "this" erreicht das Mitglied-Objekt.
		// wir binden die onload-Funktion damit, sodass "this" in der onload-Funktion das Mitglied-Objekt erreicht.
		request.send();
	}

	setAlter(neuerAlter,anzeigeFunktion) {
		const request = new XMLHttpRequest();
		let url="mitglied_alter_speichern.php?id="+this.id+"&alter="+encodeURIComponent(neuerAlter);
		request.open("GET", url, true);
		request.onload = function() {
		  if (request.status >= 200 && request.status < 300) {
			if(request.responseText=='OK') {
				// Die onload-Funktion wird im Kontext des request-Objekts ausgeführt.
				// D.h. hier würde "this" das request-Objekt erreichen, und nicht das Mitglied-Objekt.
				// Um dies zu korrigieren, benutzen wir bind(), siehe unten.
				// Alternativ könnte man ins request-Objekt merken, welches Mitglied es betrifft.
				this.alter=neuerAlter;
				anzeigeFunktion();
			} else {
				alert("Der Server antwortete: ", request.responseText);
			}
		  } else {
			alert("Error: "+request.status, request.statusText);
		  }
		}.bind(this); // hier sind wird außerhalb der onload-Funktion, "this" erreicht das Mitglied-Objekt.
		// wir binden die onload-Funktion damit, sodass "this" in der onload-Funktion das Mitglied-Objekt erreicht.
		request.send();
	}
	
	// Instanz-Methode
	//geburtstag() {
		//++this.alter;
		// Da könnte etwas automatisch passieren, z.B. Speicherung des neuen Alters in die DB
	//}
	
	// static: betrifft nicht eine Instanz, sondern die Klasse allgemein
	static alleMitglieder=[];
	// Diese Funkltion bekommt Standardobjekte vom Server und übersetzt sie zu Mitglied-Objekten
	// Sie bekommt eine Anzeige-Funktion, die sie erst dann aufruft, wenn die Daten
	// angekommen und konvertiert sind.
	static alleLaden(mitgliederAnzeigen) {
		
		const request = new XMLHttpRequest();
		request.open("GET", "mitglieder_laden.php", true);
		request.onload = function () {
		  if (request.status >= 200 && request.status < 300) {
			let daten=JSON.parse(request.responseText);
			for(let d of daten) {
				// was hier "alter" heißt, kann in der DB nicht so heißen... also "jahre"
				let m=new Mitglied(d.id,d.vorname,d.nachname,d.jahre);
				Mitglied.alleMitglieder.push(m);
			}
			mitgliederAnzeigen();
		  } else {
			alert("Error: "+request.status, request.statusText);
		  }
		};
		request.send();
	}
}




