<?php

function alerte($Niveau, $Message, $Fichier, $Ligne, $Variables)
	{
	// Prévention
	$GLOBALS['alerte'] = TRUE;

	/*
	// Log
	$Log  = date("d/m/y H:i:s")."\n";
	$Log .= "Alerte dans \"".$Fichier."\" ligne ".$Ligne.":\n";
	if (isset($_SESSION['pseudo']))	{ $Log .= "Joueur: ".$_SESSION['pseudo']."\n"; }
	$Log .= "Message: ".$Message;
	$Log .= "\n\n";
	
	// Ecriture
	file_put_contents("logs/".$GLOBALS['token'].".txt", $Log, FILE_APPEND);
	*/
	}

?>
