<?php

function cookie($Nom, $Valeur, $Expire="NA")
	{
	/* Expire par défaut : 10 ans */
	if (!preg_match("#^[0-9]+$#", $Expire))
		{ $Expire = time() + 60*60*24*365*10; }
	
	/* Stockage client */
	setcookie(
		$Nom,
		$Valeur,
		$Expire		
		);
	
	/* Disponibilité immédiate */
	$_COOKIE[ $Nom ] = $Valeur;
	}

?>
