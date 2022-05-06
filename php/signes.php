<?php

function signes( $Texte )
	{
	$Resultat = $Texte;
	
	$Resultat = htmlspecialchars($Resultat, ENT_COMPAT, 'ISO-8859-1');
	$Resultat = preg_replace("#§#", "&#167;", $Resultat);
	
	return $Resultat;
	}

?>
