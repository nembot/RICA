<?php

function header_memo($Pages)
	{
	/* Secteurs */
	$Secteurs = "";
	$X = array(25, 75, 125, 175, 225);
	$Y = array(25, 75, 125, 175, 225);
	foreach($X as $x)
		{
		foreach($Y as $y)
			{
			$S = fonction("secteur", array($x, $y, TRUE, FALSE));
			$Secteurs .= "\t\t\t\t\t<option>".$S."\n";
			}
		}
	
	/* Visibilité */
	if (isset($Pages['memo']['class']))	{ $Display = ""; }
	else								{ $Display = " style=\"display: none\""; }
	
	/* Affichage */
	$Header = "
		<form action=\"index.php?P=recherche\" method=\"post\" id=\"form_memo\"".$Display.">
			<input type=\"submit\" class=\"submit\" value=\"Ajouter\" name=\"memo\"><br>
			Date : <input type=\"text\" class=\"date\" name=\"date\"><br>
			<span class=\"attention\">Titre</span> : <input type=\"text\" id=\"titre_memo\" name=\"titre\"><br>
			Joueur : <select name=\"joueur\" onClick=\"selectJoueur(this, 'memo')\"></select><br>
			Position : <input type=\"text\" id=\"x\" name=\"x\"> / <input type=\"text\" id=\"y\" name=\"y\"><br>
			Secteur : <select name=\"secteur\" id=\"secteur\"><option>automatique".$Secteurs."</select><br>
			<select name=\"type\" id=\"type\"><option><option>Flotte<option>Planète<option>Centre d'influence</select> : <input type=\"text\" id=\"nom\" name=\"nom\"> (<input type=\"text\" id=\"numero\" name=\"numero\">)<br>
			Détails : <input type=\"text\" id=\"details\" name=\"details\"><br>
			<p>Pour stocker un message libre (planète repérée, cible réservée ...). Le titre apparaitra dans la liste de résultats, les autres champs qui auront été remplis dans les détails. Merci de ne pas en abuser, il ne s'agit pas d'une messagerie instantannée !</p>
		</form>";
	
	return $Header;
	}

?>
