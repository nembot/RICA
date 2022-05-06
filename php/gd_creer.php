<?php

// Initialise un array de type GD
// - Largeur, Hauteur : dimension de l'image en pixels
// - Couleurs : array nommé de couleurs hexadécimales (avec "#")
// - Inverser : inverser l'axe Y (origine en bas) ou non (origine en haut)

// GD = array(
//    image          Ressource image,
//    couleurs       Array nommé de couleurs allouées ("fond" donne la couleur de fond, noir par défaut)
//    dimensions     Array("X", "Y") donnant la taille de l'image en pixels
//    limites        Array("Xmin", "Xmax", "Ymin", "Ymax") donnant les coordonnées des points extrèmes de l'image
//    marges         Array("X1", "X2", "Y1", "Y2") donnant la largeur des différentes marges en pixels
//    inners         Array("X", "Y") donnant l'espace entre l'axe et l'origine en pixels
//    )
		
function gd_creer($Largeur, $Hauteur, $Couleurs, $Inverser=TRUE)
	{
	/* Création de l'objet image */
	$Image = imagecreate($Largeur, $Hauteur);
	
	/* Allocation des couleurs */
	foreach($Couleurs as &$C)
		{
		if (preg_match("/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})(?:\:([0-9]+))?$/i", $C, $Matches))
			{
			if (!isset($Matches[4]))	{ $Matches[4] = 0; }
			$C = imagecolorallocatealpha($Image, hexdec($Matches[1]), hexdec($Matches[2]), hexdec($Matches[3]), $Matches[4]);
			}
		else { exit("Format de couleur incorrect"); }
		}
	
	/* Fond */
	if (array_key_exists("fond", $Couleurs))	{ $Fond = $Couleurs['fond']; }
	else										{ $Fond = imagecolorallocatealpha($Image,0,0,0,0); }
	imagefill($Image, 0, 0, $Fond);
	
	/* Objet */
	return array(
		"image" => $Image,
		"couleurs" => $Couleurs,
		"inverser" => $Inverser,
		"dimensions" => array(
			"X" => $Largeur,
			"Y" => $Hauteur
			),
		"marges" => array(
			"X1" => 30,
			"X2" => 15,
			"Y1" => 15,
			"Y2" => 15
			),
		"inners" => array(
			"X" => 3,
			"Y" => 3
			)
		);
	}

?>
