<?php

function carte_elements($Array)
	{
	$Elements = array();
	
	/* Titre */
	$Titre = "Carte de la galaxie entre";
	$Titre .= " ".$Array['Xmin']."/-".$Array['Ymin'];
	$Titre .= " et ".$Array['Xmax']."/-".$Array['Ymax'];
	$Titre .= " (".$Array['secteur'].")";
	$Elements[] = array(
		"nom" => "",
		"contenu" => $Titre
		);
	
	/* Posteur */
	$Elements[] = array(
		"nom" => "Ajouté par",
		"contenu" => $_SESSION['pseudo']
		);
	
	/* Type */
	$Elements[] = array(
		"nom" => "Type",
		"contenu" => "Carte détaillée"
		);
	
	/* Secteur */
	$Elements[] = array(
		"nom" => "Secteur",
		"contenu" => $Array['secteur']
		);
	
	/* Objets */
	foreach($Array['objets'] as $O)
		{
		$Elements[] = array(
			"contenu" => "<p>".$O['type']." : ".$O['nom']." (".$O['numero'].")</p><p>Joueur : ".$O['joueur']."</p><p>Clan : ".$O['clan']."</p>"
			);
		}
	
	return $Elements;
	}

?>
