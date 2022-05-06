<?php

function compteCarte($Image, $X1, $Y1, $X2, $Y2)
	{
	/* Initialisation */
	$Compte = array();
	$Compte['flottes']['contrebande'] = 0;
	$Compte['flottes']['empire'] = 0;
	$Compte['flottes']['rebellion'] = 0;
	
	/* Décompte */
	for($X=$X1;$X<=$X2;$X++)
		{
		for($Y=$Y1;$Y<=$Y2;$Y++)
			{
			$I = imagecolorat($Image, $X*3+1, $Y*3+1);
			if ($I != 0)
				{
				switch($I)
					{
					case  8: $Compte['flottes']['contrebande']++; break;
					case  9: $Compte['flottes']['rebellion']++; break;
					case 10: $Compte['flottes']['empire']++; break;
					}
				}
			
			}
		}
	
	return $Compte;
	}

?>
