<?php

function estiPAV( $Perso, $MaxUnite, $Type )
	{
	/* Valeurs connues */
	$Unites = fonction("unites");
	$Parsecs = $Perso['Parsecs'];
	$Planetes = $Perso['Planetes'];

	/* Valeurs inconnues */
	if ($Type == "Min")
		{
		$Bat = array(
			"Garnison" => 0,
			"Construction" => 0,
			"Entrainement" => 0,
			"Recherche" => 0,
			"Maintenance" => 0
			);
		$Recherches = $Unites[ $MaxUnite ]['Recherche'];
		}
	elseif ($Type == "Max")
		{
		$Bat = array(
			"Garnison" => 0,
			"Construction" => 0,
			"Entrainement" => 0,
			"Recherche" => 0,
			"Maintenance" => $Parsecs
			);
		$Recherches = $Unites[18]['Recherche'];
		}
	else { exit("Type de PAV inconnu"); }


	/* Calcul */
	$PAV = 500000;
	$PAV += $Bat['Garnison']*3.6 + $Bat['Construction']*3.2 + $Bat['Entrainement']*4.4 + $Bat['Recherche']*4.8 + $Bat['Maintenance']*5.2;
	$PAV += $Recherches*250 + $Parsecs*30 + $Planetes*150000;
	$PAV = ceil($PAV);

	return($PAV);
	}

?>
