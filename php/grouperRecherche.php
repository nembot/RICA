<?php

function grouperRecherche($Messages)
	{
	$Sortie = array();
	$Joueurs = array();
	$I = 0;
	
	/* Selection par cible, le plus récent */
	foreach($Messages as $M)
		{
		/* Eléments utiles */
		if (preg_match("#§Type : Rapport#", "§".$M['elements']) AND preg_match("#§Joueur : ([^§]+)§#", "§".$M['elements']."§", $Matches))
			{
			/* Nouvelle cible */
			if (!in_array($Matches[1], $Joueurs))
				{
				$Sortie[$I] = $M;
				$Sortie[$I]['GROUPER'] = strtolower($Matches[1]);
				$Joueurs[] = $Matches[1];
				$I++;
				}
			}
		}
	
	/* Tri par cible */
	$Sortie = fonction("triSQL", array($Sortie, array("GROUPER"), array("ASC"), array("STRING")));
	
	return $Sortie;
	}

?>
