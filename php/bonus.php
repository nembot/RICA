<?php

function bonus()
	{
	/* Données */
	$Simples = array(
		 1 => "4,5",
		 2 => "1,5",
		 3 => "1,2",
		 4 => "2,3",
		 5 => "3,4",
		 6 => "8,9,15,16,18",
		 7 => "6,8,12,15,16,18",
		 8 => "10,14,18",
		 9 => "7,13,14,15,16,18",
		10 => "6,7,9",
		11 => "7,10,11,17",
		12 => "12",
		13 => "9,10,13,14",
		14 => "8,10,12",
		15 => "11,12,13,17",
		16 => "11,12,13,14,17",
		17 => "6,10,13,14",
		18 => "12,13,14,15,16"
		);
	$Doubles = array(
		10 => "18",
		12 => "10",
		18 => "11,17"
		);

	/* Matrice */
	$Sortie = array();
	$I = 1;
	while($I <= 18)
		{
		$J = 1;
		while($J <= 18)
			{
			$Sortie[$I][$J] = 0;
			$J++;
			}
		$I++;
		}

	/* Remplissage */
	foreach($Simples as $I => $V)
		{
		$Cibles = preg_split("#,#", $V);
		foreach($Cibles as $C)
			{ $Sortie[$I][$C] = 1; }
		}
	foreach($Doubles as $I => $V)
		{
		$Cibles = preg_split("#,#", $V);
		foreach($Cibles as $C)
			{ $Sortie[$I][$C] = 2; }
		}

	return $Sortie;
	}

?>
