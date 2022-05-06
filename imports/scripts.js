function selectJoueur(Element, Type)
	{
	if (Element.innerHTML.length < 100)
		{
		var BDD = joueurs(); /* 0:Pseudo 1:IDs 2:Clan */
		var Clans = new Array("Neutre", "Contrebande", "Empire", "Rebellion");
		var i = 0;
		
		switch(Type)
			{
			case "recherche":
				while(BDD[i]) {
					Element.options[i+1] = new Option(BDD[i][0], "Joueur : "+BDD[i][0]);
					Element.options[i+1].className = Clans[BDD[i][2]];
					i++;
				}
				break;
			case "memo":
				while(BDD[i]) {
					Element.options[i+1] = new Option(BDD[i][0], BDD[i][0]);
					Element.options[i+1].className = Clans[BDD[i][2]];
					i++;
				}
				break;
			case "ids":
				while(BDD[i]) {
					Element.options[i+1] = new Option(BDD[i][0], BDD[i][1]);
					Element.options[i+1].className = Clans[BDD[i][2]];
					i++;
				}
				break;
			default: alert("Erreur JavaScript, contactez un administrateur");
			}
		}
	}

function survol_on( ID )
	{
	/* Contenu */
	document.getElementById('tr_info').innerHTML = document.getElementById('Leg'+ID).innerHTML;
	
	/* Position */
	var left = parseInt( document.getElementById('Img'+ID).style.left );
	var top = parseInt( document.getElementById('Img'+ID).style.top );
	document.getElementById('legende_info').style.left = (left+32).toString() + "px";
	document.getElementById('legende_info').style.top = (top+32).toString() + "px";
	document.getElementById('table_info').style.left = (left+32+100).toString() + "px";
	document.getElementById('table_info').style.top = (top+32).toString() + "px";
	
	/* Affichage */
	document.getElementById('table_info').style.display = "table"
	document.getElementById('legende_info').style.display = "table"
	}

function survol_off( ID )
	{
	document.getElementById('table_info').style.display = "none"
	document.getElementById('legende_info').style.display = "none"
	}

function Ajouter( Txt, ID )
	{
	if (Txt != "NULL")
		{
		if (document.getElementById( ID ).innerHTML == "")
			{ document.getElementById( ID ).innerHTML += Txt; }
		else	{ document.getElementById( ID ).innerHTML += " + " + Txt; }
		}
	}

function Vider( ID )
	{ document.getElementById( ID ).innerHTML = ""; }

function derouler( ID )
	{
	/* Sens */
	if (document.getElementById(ID).className == "ferme")	{ document.getElementById(ID).className = "ouvert"; }
	else													{ document.getElementById(ID).className = "ferme"; }
	}

function toutlu()
	{
	document.cookie = 'nouveaux=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
	alert("Tous les sujets ont été marqués comme lus")
	}

function desel()
	{
	/* Images */
	var carte = document.getElementById('carte');
	var img = carte.getElementsByTagName('img');
	var I=0; while(I < img.length)
		{ img[I].className = img[I].className.replace(/ .+$/, ""); I++; }

	/* Légende */
	var legende = document.getElementById('legende');
	var trs = legende.getElementsByTagName('tr');
	var D=0; while(D < trs.length)
		{ trs[D].className = ""; D++; }
	}

function selection( ID )
	{
	var classes = document.getElementById( "Img" + ID ).className.split(" ");
	if (classes.length == 1)
		{
		desel();
		document.getElementById( "Leg" + ID ).className = "selection";
		document.getElementById( "Img" + ID ).className = classes[0] + " selection";
		}
	else { desel(); }
	}

function onglet( onglet, form )
	{
	/* Contenu */
	var liste = document.getElementById('header');
	var balise = liste.getElementsByTagName('form');
	var I=0; while(I < balise.length)
		{ balise[I].style.display = "none"; I++; }
		
	/* Onglet */
	var liste = document.getElementById('ongletsHeader');
	var balise = liste.getElementsByTagName('span');
	var I=0; while(I < balise.length)
		{ balise[I].className = ""; I++; }
	
	/* Cible */
	onglet.className = "selection";
	document.getElementById( form ).style.display = "block";
	}

function entree( evenement, formulaire )
	{
	if (evenement.which)		{ var touche = evenement.which; }
	else if (evenement.keyCode)	{ var touche = evenement.keyCode; }
	if (touche == 13)
		{ document.getElementById( formulaire ).submit(); }
	}
