<?php

function regex($Chaine, $Delimiter="#")
	{
	/* Caractères classiques */
	$Chaine = preg_quote($Chaine, $Delimiter);
	
	/* Lettres accentuées */
	$Pattern = array("[aâàä]", "[eêéèë]", "[iîï]", "[oöô]", "[uûü]", "[cç]");
	foreach($Pattern as $P)
		{ $Chaine = preg_replace("#".$P."#", $P, $Chaine); }
	
	return $Chaine;
	}

?>
