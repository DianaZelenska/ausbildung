import { Seite } from './Seite.js';

export class StadtlisteSeite extends Seite {
	constructor(staedte) {
		super('Städte - Liste');
		this.staedte=staedte;
	}
	
	initGUI() {
		super.initGUI();
		let table=document.createElement('table');
		table.border=1;
		table.style.borderCollapse='collapse';
		
		let tr=table.insertRow();
		let th=document.createElement('th');
		th.innerText='Name';
		tr.appendChild(th);
		th=document.createElement('th');
		th.innerText='Einwohnerzahl';
		tr.appendChild(th);
		
		//PHP: foreach($staedte as $stadt) { ... }
		//Java: for(Stadt stadt:staedte) { ... }
		//C#: foreach(Stadt stadt in staedte) { ... }
		for(let stadt of this.staedte) {
			tr=table.insertRow();
			let td=tr.insertCell();
			td.innerText=stadt.stadtname;
			td=tr.insertCell();
			td.align='right';
			td.innerText=stadt.einwohnerzahl;
		}
		
		document.body.appendChild(table);
	}
	
}

