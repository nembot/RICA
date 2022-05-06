<?php

function affStats()
	{
	$Sortie = "\n\t\t<div id=\"body\">";
	
	/* Récupération */
	$Images = array();
	$Dossier = opendir("statistiques");
	while($Image = readdir($Dossier))
		{ if (preg_match("#\.png$#", $Image)) { $Images[] = $Image; } }
	sort($Images);
	
	$Sortie .= "<a href=\"statistiques/RICA_Statistiques.txt\" target=\"_blank\">Données brutes au format TXT</a><br>";
	$Sortie .= "<br>";
	
	/* Affichage */
	foreach($Images as $I)
		{ $Sortie .= "<img src=\"statistiques/".$I."\" alt=\"".preg_replace("#\.png#", "", $I)."\"><br><br>"; }
	
	/* Coordonnées */
	$Hoth = fonction("SQL", array("SELECT valeur FROM informations WHERE nom='hoth'", __LINE__,"VAL",__FILE__));
	$Coru = fonction("SQL", array("SELECT valeur FROM informations WHERE nom='coruscant'", __LINE__,"VAL",__FILE__));
	
	/* Légende */
	$Sortie .= "<span class=\"clef\">Entrées :</span> Rapports, Cartes ou Memo postés sur RICA sans distinction<br>";
	$Sortie .= "<span class=\"clef\">Flottes Coru :</span> Flottes à 5 cases ou moins de ".$Coru." selon la carte de la galaxie<br>";
	$Sortie .= "<span class=\"clef\">Flottes Hoth :</span> Flottes à 5 cases ou moins de ".$Hoth." selon la carte de la galaxie<br>";
	$Sortie .= "<span class=\"clef\">SWING Actifs :</span> Plus de 5000 parsecs ou niveau supérieur à 0<br>";
	$Sortie .= "<span class=\"clef\">RICA Actifs :</span> Joueurs avec au moins une entrée postée ces 8 derniers jours<br>";
	$Sortie .= "<br>";
	$Sortie .= "Données collectées à 0h, 8h et 16h chaque jour.<br>";
	$Sortie .= "La couleur noire correspond aux comptes supprimés.<br>";
	$Sortie .= "\n\t\t</div>";
	
	return $Sortie;
	}

?>
