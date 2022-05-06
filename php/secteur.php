<?php

function secteur($X, $Y, $Capitales=TRUE, $Ceintures=5)
	{
	/* Signes */
	$X = abs($X);
	$Y = abs($Y);
	
	$Colonnes = array("A", "B", "C", "D", "E", "F");
	$Secteur = $Colonnes[ floor($X/50) ].(floor(abs($Y)/50)+1);
	if ($Capitales)
		{
		/* Noms des secteurs clés */
		if ($Secteur == "B3")      { $Secteur = "Coruscant"; }
		else if ($Secteur == "D3") { $Secteur = "Hoth"; }
		else                       { $Ceintures = FALSE; }
		
		/* Ceintures */
		if ($Ceintures !== FALSE)
			{
			$Position = fonction("SQL", array("SELECT valeur FROM informations WHERE nom=\"".strtoupper($Secteur)."\"", __LINE__,"VAL",__FILE__));
			preg_match('#^([0-9]+)/([0-9]+)$#', $Position, $M);
			$C = max(abs($M[1]-$X), abs($M[2]-$Y));
			if ($C <= $Ceintures) { $Secteur .= " ~".$C; }
			}
		}
	
	return $Secteur;
	}

?>
