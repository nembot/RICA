<?php

function affRecherche_bbc($Messages, $Mots)
	{
	/* En-t�te HTML */
	$Sortie  = "\n\t\t\t<div class=\"reponse\">";
	$Sortie .= "<div class=\"aide\">Cliquez dans la zone de texte, tappez Ctrl + A pour tout selectionner puis Ctrl + C pour copier.<br>Dans votre message de forum, tappez Ctrl + V pour coller les informations formattées sur les VIP</div>";
	$Sortie .= "<textarea rows=1 cols=1 id=\"BBCode\">";


	$Sortie .= "[list]";
	foreach($Messages as $M)
		{
		/* Traitement des éléments */
		$Tableau = fonction("assocElements", array($M['elements']));
		if (array_key_exists("Restent", $Tableau))
			{ $Tableau['Dense'] = fonction("restentDense", array($Tableau['Restent'], $Tableau['Clan'])); }
		else { $Tableau['Dense'] = ""; }

		/* Rapports de combats */
		if (preg_match("#^Rapport#", $Tableau['Type']))
			{
			$Sortie .= "\n[*]";

			if ($M['isJoint'])	{ $Sortie .= "[url=http://rica.ovsa.fr/joint.php?E=".$M['IDe']."]"; }
			$Sortie .= fonction("temps", array("TvD", $M['date'], "#N2/#M2/#A2 � #H2:#I2"));
			if ($M['isJoint'])	{ $Sortie .= "[/url]"; }

			$Sortie .= " [b]:[/b] ".fonction("BBClan", array("[b]".$Tableau['Joueur']."[/b]", $Tableau['Clan']));

			$Sortie .= " [b]:[/b] ".$Tableau['Dense'];

			if (array_key_exists("Puissance", $Tableau) AND !in_array($Tableau['Puissance'], array("inconnue", "")))
				{ $Sortie .= " [b](".$Tableau['Puissance'].")[/b]"; }
			}
		}
	$Sortie .= "\n[/list]";

	/* Rappel de la recherche */
	$Sortie .= "\n\n[size=80][i]";
	$Sortie .= " Généré par [url=http://rica.ovsa.fr]RICA[/url]";
	$Sortie .= " pour le clan ".fonction("BBClan", array($_SESSION['clan'], $_SESSION['clan']));
	$Sortie .= " le ".date("d/m/Y � H:i:s");
	$Sortie .= " avec la requ�te [b]".$GLOBALS['recherche']."[/b]";
	if ($GLOBALS['grouper'])	{ $Sortie .= " group�e par cible"; }
	else					{ $Sortie .= " sans groupement"; }
	if ($GLOBALS['limite'] !== FALSE)
		{
		if ($GLOBALS['heures'])		{ $Sortie .= " limit�e � ".$GLOBALS['limite']." heures"; }
		else if ($GLOBALS['jours'])	{ $Sortie .= " limit�e � ".$GLOBALS['limite']." jours"; }
		}
	else { $Sortie .= " sans limite de temps";}
	$Sortie .= ".[/i][/size]";


	/* Pied HTML */
	$Sortie .= "</textarea>";
	$Sortie .= "</div>";

	return $Sortie;
	}

?>
