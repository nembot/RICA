<?php

// Trace les axes en tenant compte des marges, limites et inversions
// - Array : array de classe GD
// - X, Y : quel(s) axe(s) tracer

function gd_axes($Array, $X=TRUE, $Y=TRUE)
	{
	/* Couleur */
	if (array_key_exists("axes", $Array['couleurs']))	{ $Axes = $Array['couleurs']['axes']; }
	else												{ $Axes = imagecolorallocatealpha($Array['image'],60,60,60,0); }
	
	/* Axe X */
	if ($X)
		{
		/* Hauteur de l'axe */
		if ($Array['inverser']) { $Decalage = 5;  $Hauteur = $Array['dimensions']['Y'] - $Array['marges']['Y2']; }
		else                    { $Decalage = -10; $Hauteur = $Array['marges']['Y1']; }
		
		/* Trait */
		imageline($Array['image'],
			$Array['marges']['X1'] + $Array['inners']['X'],
			$Hauteur,
			$Array['dimensions']['X'] - $Array['marges']['X2'],
			$Hauteur,
			$Axes
			);
		
		/* Valeur gauche */
		imagestring($Array['image'],
			1,
			$Array['marges']['X1'] + $Array['inners']['X'],
			$Hauteur + $Decalage,
			$Array['limites']['Xmin'],
			$Axes
			);
		
		/* Valeur droite */
		imagestring($Array['image'],
			1,
			$Array['dimensions']['X'] - $Array['marges']['X2'] - 5*strlen($Array['limites']['Xmax']) - 2,
			$Hauteur + $Decalage,
			$Array['limites']['Xmax'],
			$Axes
			);
		}
	
	/* Axe Y */
	if ($Y)
		{
		/* Valeurs et inners*/
		if ($Array['inverser'])
			{
			$Haut = $Array['limites']['Ymax'];
			$Bas = $Array['limites']['Ymin'];
			$InnerHaut = 0;
			$InnerBas = $Array['inners']['Y'];
			}
		else
			{
			$Haut = $Array['limites']['Ymin'];
			$Bas = $Array['limites']['Ymax'];
			$InnerHaut = $Array['inners']['Y'];
			$InnerBas = 0;
			}
		
		/* Trait */
		imageline($Array['image'],
			$Array['marges']['X1'],
			$Array['marges']['Y1'] + $InnerHaut,
			$Array['marges']['X1'],
			$Array['dimensions']['Y'] - $Array['marges']['Y2'] - $InnerBas,
			$Axes
			);
				
		/* Valeur haute */
		imagestring($Array['image'],
			1,
			$Array['marges']['X1'] - 5*strlen($Haut) - 2,
			$Array['marges']['Y1'] + $InnerHaut,
			$Haut,
			$Axes
			);
		
		/* Valeur basse */
		imagestring($Array['image'],
			1,
			$Array['marges']['X1'] - 5*strlen($Bas) - 2,
			$Array['dimensions']['Y'] - $Array['marges']['Y2'] - $InnerBas - 7,
			$Bas,
			$Axes
			);
		}
	
	return $Array;
	}

?>
