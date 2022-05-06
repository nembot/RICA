<?php

function exportStats()
	{
	/* Header */
	$Header = array("Date","Categorie","Contrebande","Empire","Neutre","Rebellion");
	$Fichier = implode($Header, "\t")."\n";
	
	/* Données */
	$Table = fonction("SQL", array("SELECT * FROM statistiques ORDER BY date ASC, categorie ASC",__LINE__,"TAB",__FILE__));
	foreach($Table as $Ligne)
		{ $Fichier .= implode($Ligne, "\t")."\n"; }
		
	/* Ecriture */
	if (file_put_contents("statistiques/RICA_Statistiques.txt", $Fichier))
	     { echo "exportStats() : Ecriture réussie\n"; }
	else { echo "exportStats() : Echec de l'écriture\n"; }
	}

?>
