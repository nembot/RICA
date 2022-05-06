<?php

function header_connexion()
	{
	/* Connexion */
	$Header = "
	<div id=\"header\">
		<form action=\"\" method=\"post\">
			<input name=\"connexion\" type=\"submit\" class=\"submit\" value=\"Se connecter\">
			<select name=\"identite\" onClick=\"selectJoueur(this, 'ids')\"><option value=\"\">Votre identité</select>
			<input name=\"pass\" type=\"password\">
			Connexion automatique <input type=\"checkbox\" name=\"auto\">
		</form>
	</div>";
	
	return $Header;
	}

?>
