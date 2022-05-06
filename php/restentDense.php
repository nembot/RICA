<?php

// Remplace les noms d'unités restantes après un assocElements() en leurs raccourcis
function restentDense($Restent, $Clan)
	{
	/* Initialisations */
	$Dense = "";
	switch($Clan)
		{
		case "Contrebande":	$Lettre = "c"; break;
		case "Empire":		$Lettre = "e"; break;
		case "Rebellion":	$Lettre = "r"; break;
		}
	$Unites = fonction("unites");
	
	/* Remplacement */
	$Splits = preg_split("#, #", $Restent);
	foreach($Splits as $U)
		{
		preg_match("/^([0-9\.]+ )?.+ \(#([0-9]+)\)$/", $U, $Matches);
		$Dense .= $Matches[1]."".$Unites[ $Matches[2] ][ $Lettre ].", ";
		}
	
	/* Virgule finale */
	$Dense = substr($Dense, 0, -2);
	
	return $Dense;
	}

?>
