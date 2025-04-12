export class Seite {
    // Member-Variablen definieren ist erlaubt aber nicht nötig,
    // solange der Konstruktor sie initialisiert.
    //var titel;

    constructor(titel) {
        this.titel=titel;
    }

    initGUI() {
        document.title=this.titel;

        let h1=document.createElement('h1'); //<h1>...titel...</h1>
		h1.innerText=this.titel;
		document.body.appendChild(h1);
		
		let menue=document.createElement('div'); //<div>...</div>
		menue.className='menue';  //class="menue" 
		document.body.appendChild(menue);
		
		let item=document.createElement('a'); //<a href="index.php">Startseite</a>
		item.innerText='Startseite';
		item.href='index.php';
		menue.appendChild(item);

    }
}