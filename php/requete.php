<?php

function requete( $Mots, $Index )
	{
	$Sortie = "";
	
	/* Requete fixe */
	$Requete = "
		SELECT
			IDe,
			date,
			pseudo,
			entrees.clan,
			elements,
			joint IS NOT NULL as isJoint
		FROM
			entrees
			LEFT JOIN classement USING(IDs)
		WHERE entrees.clan = \"".$_SESSION['clan']."\"";
	
	/* Limite */
	$Lim = FALSE;
	if ($GLOBALS['limite'] !== FALSE)
		{
		if ($GLOBALS['heures'])		{ $Requete .= " AND HOUR(TIMEDIFF(NOW(), date)) <= ".$GLOBALS['limite']; $Lim = TRUE; }
		else if ($GLOBALS['jours'])	{ $Requete .= " AND DATEDIFF(NOW(), date) <= ".$GLOBALS['limite']; $Lim = TRUE; }
		}
	
	/* Filtres */
	foreach($Mots as &$M)
		{
		/* Not */
		if (substr($M, 0, 1) == "!")	{ $Not = "NOT "; $M = preg_replace("#^! *#", "", $M); }
		else						{ $Not = ""; }
		
		/* "%" et "_" sont des joker pour LIKE */
		$M = preg_replace(array("#%#", "#_#"), array("\%", "\_"), $M);
		
		$Requete .= " AND elements ".$Not."LIKE \"%".$M."%\"";
		}
	
	/* Ordre */
	$Requete .= "\n\t\tORDER BY date DESC";
	
	/* Index */
	if (count($Mots) == 0 AND !$Lim)
		{
		$Requete .= "\n\t\tLIMIT 0, ".$Index;
		$GLOBALS['dialogues'][] = array("type" => "confirmation", "message" => "Recherche vide, affichage des ".$Index." dernières entrées");
		}
	
	return $Requete;
	}

?>
