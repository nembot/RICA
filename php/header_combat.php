<?php

function header_combat($Pages)
	{
	/* Visibilité */
	if (isset($Pages['combat']['class']))	{ $Display = ""; }
	else								{ $Display = " style=\"display: none\""; }
	
	/* Affichage */
	$Header = "
		<form action=\"index.php?P=recherche\" method=\"post\" id=\"form_combat\"".$Display.">
			<input type=\"submit\" class=\"submit\" value=\"Ajouter\">
			Date : <input type=\"text\" class=\"date\" name=\"date\">
			Puissance : <input type=\"text\" id=\"puissance\" name=\"puissance\">
			<textarea name=\"combat\" id=\"txt_combat\" rows=1 cols=10 onKeyDown=\"touche(event, 'combat')\"></textarea>
			<p>Copiez le texte complet du rapport (attaque ou défense, planête ou flotte, peu importe) et collez le ici. Si vous n'entrez pas la puissance restante de la cible, une approximation sera calculée à partir des unités restantes. Si la date n'est pas renseignée (aaaa-mm-jj hh:nn(:ss)) la date actuelle sera utilisée.</p>
		</form>";
	
	return $Header;
	}

?>
