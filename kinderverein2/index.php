<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Standard-Objekte in JS (ohne Klassen)</title>
  <script type="module">
	// Thema: Kinder-Fussballverein
	import { Mitglied } from './Mitglied.js';
	
	const btnHinzufuegen=document.createElement('button');
	btnHinzufuegen.type='button';
	btnHinzufuegen.innerText='Neues Mitglied';
	btnHinzufuegen.onclick=function() {
		const formHinzufuegen=document.createElement('form');
		formHinzufuegen.method='post';
		formHinzufuegen.acceptCharset='utf-8';
		formHinzufuegen.enctype='multipart/form-data';
		formHinzufuegen.action='mitglied_speichern.php';
		
		let tableHinzufuegen=document.createElement('table');
		
		let tr=tableHinzufuegen.insertRow();
		let th=document.createElement('th');
		th.innerText='Vorname';
		tr.appendChild(th);
		let td=tr.insertCell();
		const inputVorname=document.createElement('input');
		inputVorname.type='text';
		inputVorname.name='vorname';
		td.appendChild(inputVorname);
		
		tr=tableHinzufuegen.insertRow();
		th=document.createElement('th');
		th.innerText='Nachname';
		tr.appendChild(th);
		td=tr.insertCell();
		const inputNachname=document.createElement('input');
		inputNachname.type='text';
		inputNachname.name='nachname';
		td.appendChild(inputNachname);
		
		tr=tableHinzufuegen.insertRow();
		th=document.createElement('th');
		th.innerText='Alter';
		tr.appendChild(th);
		td=tr.insertCell();
		const inputAlter=document.createElement('input');
		inputAlter.type='number';
		inputAlter.min=6;
		inputAlter.name='alter';
		td.appendChild(inputAlter);
		
		tr=tableHinzufuegen.insertRow();
		th=document.createElement('th');
		tr.appendChild(th);
		td=tr.insertCell();
		let btnSpeichern=document.createElement('button');
		btnSpeichern.type='button';
		btnSpeichern.innerText='Speichern';
		btnSpeichern.onclick=function() {
			// Dies ist eine Business-Logik-Funktion,
			// es wäre schöner, sie nicht hier mitten in der GUI-Definition
			// zu schreiben, sondern zu verlagern; allerdings müsste man
			// dann die Variablen, die die betroffenen GUI-Elemente enthalten,
			// global machen.
			let vorname=inputVorname.value;
			if(!vorname) {
				alert('Bitte einen Vornamen eingeben');
				inputVorname.focus();
				return;
			}
			let nachname=inputNachname.value;
			if(!nachname) {
				alert('Bitte einen Nachnamen eingeben');
				inputNachname.focus();
				return;
			}
			let alter=inputAlter.value;
			if(!alter) {
				alert('Bitte ein Alter eingeben');
				inputAlter.focus();
				return;
			}
			formHinzufuegen.submit();
		}
		td.appendChild(btnSpeichern);
		let btnAbbrechen=document.createElement('button');
		btnAbbrechen.type='button';
		btnAbbrechen.innerText='Abbrechen';
		btnAbbrechen.onclick=function() {
			formHinzufuegen.remove();
			btnHinzufuegen.style.display='';
		}
		td.appendChild(btnAbbrechen);
		
		
		formHinzufuegen.appendChild(tableHinzufuegen);
		
		//Formular vor dem Button hinzufügen, der es öffnet
		document.body.insertBefore(formHinzufuegen,btnHinzufuegen);
		// Button verstecken, damit das Formular nicht zweimal hinzugefügt wird
		btnHinzufuegen.style.display='none';
	};
	document.body.appendChild(btnHinzufuegen);
	
	const tMitglieder=document.createElement('table');
	tMitglieder.border=1;
	tMitglieder.style.borderCollapse='collapse';
	
	let headerRow=tMitglieder.insertRow();
	let th=document.createElement('th');
	th.innerText='Vorname';
	headerRow.appendChild(th);
	th=document.createElement('th');
	headerRow.appendChild(th);
	th=document.createElement('th');
	th.innerText='Nachname';
	headerRow.appendChild(th);
	th=document.createElement('th');
	headerRow.appendChild(th);
	th=document.createElement('th');
	th.innerText='Alter';
	headerRow.appendChild(th);
	th=document.createElement('th');
	headerRow.appendChild(th);
	
	document.body.appendChild(tMitglieder);
	
	// Mitglieder Anzeigen darf erst nach dem Laden passieren,
	// und zwar nicht nur nach der Anfrage nach Daten, sondern erst
	// dann, wie die Daten angekommen sind.
	// Wir definieren hier eine Funktion, die dann aufgerufen werden soll.
	function mitgliederAnzeigen() {
		for(const m of Mitglied.alleMitglieder) { 
			let tr=tMitglieder.insertRow(); //<tr></tr>
			
			const tdVorname=tr.insertCell(); //<td>Albert</td>
			tdVorname.innerText=m.vorname;
			
			let td=tr.insertCell();
			let btnVornameEdit=document.createElement('button');
			btnVornameEdit.type='button';
			btnVornameEdit.innerText='🖉';
			btnVornameEdit.onclick=function() {
				const neuerVorname=prompt('Neuer Vorname:',m.vorname);
				if(!neuerVorname || neuerVorname==m.vorname) {
					return;
				}
				m.setVorname(neuerVorname,function(){
					tdVorname.innerText=neuerVorname;
				});
			};
			td.appendChild(btnVornameEdit);
			
			const tdNachname=tr.insertCell();
			tdNachname.innerText=m.nachname;

			td=tr.insertCell();
			let btnNachnameEdit=document.createElement('button');
			btnNachnameEdit.type='button';
			btnNachnameEdit.innerText='🖉';
			btnNachnameEdit.onclick=function() {
				const neuerNachname=prompt('Neuer Nachname:',m.nachname);
				if(!neuerNachname || neuerNachname==m.nachname) {
					return;
				}
				m.setNachname(neuerNachname,function(){
					tdNachname.innerText=neuerNachname;
				});
			};
			td.appendChild(btnNachnameEdit);
			
			// Die Klick-Funktion will Zugriff: const
			const tdAlter=tr.insertCell(); //<td align="right">7</td>
			tdAlter.innerText=m.alter;
			tdAlter.align='right';
			
			td=tr.insertCell(); //<td></td>
			let btnGeburtstag=document.createElement('button'); //<button type="button" onclick="....">Geburtstag!</button>
			btnGeburtstag.type='button';
			btnGeburtstag.innerText='Geburtstag!';
			btnGeburtstag.onclick=function() {
				// Betroffene Business-Logik im Objekt anstoßen
				//m.geburtstag();
				// Anzeige anpassen
				let neuerAlter = ++m.alter;
				m.setAlter(neuerAlter, function(){
					tdAlter.innerText=m.alter;
				})
				
			}
			
			td.appendChild(btnGeburtstag);
		}
	}
	// Wenn die Daten angekommen sind, soll die Funktion mitgliederAnzeigen() aufgerufen werden,
	// deswegen reichen wir hier sie weiter
	Mitglied.alleLaden(mitgliederAnzeigen);
  </script>
</head>
<body>
<h1>Standard-Objekte in JS (ohne Klassen)</h1>
</body>
</html>