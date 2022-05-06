<?php

// Trace des points aux coordonnées X / Y
// - Array : array de classe GD
// - X, Y : arrays de valeurs brutes parallèles
// - LabelCouleur : index de la couleur lors de la création
// - TaillePoints : rayon des points (carrés) en pixels

function gd_points($Array, $X, $Y, $LabelCouleur, $TaillePoints=1)
	{
	$I=0; while(isset($X[$I]) AND isset($Y[$I]))
		{
		/* Coordonnées converties */
		$Xcrd = fonction("gd_coord", array($Array, $X[$I], "X"));
		$Ycrd = fonction("gd_coord", array($Array, $Y[$I], "Y"));
		
		/* Rectangle autour du point */
		imagefilledrectangle($Array['image'],
			$Xcrd - $TaillePoints,
			$Ycrd - $TaillePoints,
			$Xcrd + $TaillePoints,
			$Ycrd + $TaillePoints,
			$Array['couleurs'][ $LabelCouleur ]
			);
		
		$I++;
		}
	
	return $Array;
	}

?>
