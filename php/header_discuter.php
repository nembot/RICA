<?php

function header_discuter($Pages)
	{
	/* Visibilit� */
	if (isset($Pages['discuter']['class']))	{ $Display = ""; }
	else								{ $Display = " style=\"display: none\""; }
	
	/* Sujet */
	if (isset($_GET['C']))	{ $C = "&amp;C=".$_GET['C']; }
	else					{ $C = ""; }
	
	/* Affichage */
	$Header = "
		<form action=\"index.php?P=suggestions".$C."\" method=\"post\" id=\"form_discuter\"".$Display.">
			<input type=\"submit\" class=\"submit\" value=\"Envoyer\">
			Nouveau sujet : <input type=\"text\" id=\"titre\" name=\"titre\">
			<textarea name=\"discuter\" rows=1 cols=10 id=\"txt_discuter\"></textarea>
			<p>Ouvrez un sujet d�ja existant, tappez votre message et appuyez sur \"Envoyer\" pour y r�pondre. Remplissez le petit champs <span class=\"clef\">uniquement</span> pour cr�er un nouveau sujet. Notez bien que tous les clans ont acc�s � tous les sujets. Pour les <span class=\"clef\">bugs graves</span> et les <span class=\"clef\">changements de mot de passe</span>, vous pouvez MP Nem ou Mythik sur Slack.</p>
		</form>";
	
	return $Header;
	}

?>
