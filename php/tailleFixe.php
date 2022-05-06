<?php

function tailleFixe($Texte, $Largeur, $Align="left", $Sep=" ")
	{
	if (strlen($Texte) < $Largeur)
		{
		$Espace = $Largeur - strlen($Texte);
		switch($Align)
			{
			case "left":	$Texte = str_repeat($Sep, $Espace).$Texte; break;
			case "right":	$Texte = $Texte.str_repeat($Sep, $Espace); break;
			case "center":	$Texte = str_repeat($Sep, floor($Espace/2)).$Texte.str_repeat($Sep, ceil($Espace/2)); break;
			default:		die("Paramètre Align inconnu");
			}
		}
	return $Texte;	
	}

?>
