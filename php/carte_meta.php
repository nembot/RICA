<?php

function carte_meta( $Array, $Texte )
	{
	/* Coordonnées coin haut gauche */
	preg_match("#<tr class=\"row\"><td>\-([0-9]+)</td>#", $Texte, $Y);
	preg_match("#<td>([0-9]+)</td>#", $Texte, $X);
	$Array['Xmin'] = $X[1];
	$Array['Xmax'] = "";
	$Array['Ymin'] = $Y[1];
	$Array['Ymax'] = "";
	$Array['secteur'] = "";

	return $Array;
	}

?>
