<?php

function SQL($Requete, $Ligne, $Option, $Fichier)
	{
	/* Connexion si besoin */
	if (!isset($GLOBALS['MySQL']))
		{
		$config = require 'config/config.local.php';
		$GLOBALS['mysqli'] = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
		if (mysqli_connect_error()) {
			die(mysqli_error($GLOBALS['mysqli']));
		}
		$GLOBALS['MySQL'] = TRUE;
		mysqli_query($GLOBALS['mysqli'], "SET character_set_client = 'latin1'");
		mysqli_query($GLOBALS['mysqli'], "SET character_set_results = 'latin1'");
		}
	
	/* Ex�cution de la requ�te */
	$SQL = mysqli_query($GLOBALS['mysqli'], $Requete) or $Erreur = mysqli_error($GLOBALS['mysqli']);
	$Affectes = mysqli_affected_rows($GLOBALS['mysqli']);
	
	/* Erreur */
	if (isset($Erreur))
		{
		/*	
		// Log
		$Log  = date("d/m/y H:i:s")."\n";
		$Log .= "Erreur SQL dans \"".$Fichier."\" ligne ".$Ligne.":\n";
		if (isset($_SESSION['pseudo']))	{ $Log .= "Joueur: ".$_SESSION['pseudo']."\n"; }
		$Log .= "Message: ".$Erreur."\n\n\n";
		$Log .= $Requete;
		$Log .= "\n\n";
		
		// Ecriture
		file_put_contents("logs/".$GLOBALS['token'].".txt", $Log, FILE_APPEND);
		*/

		// Stop
		header("Location: index.php?P=erreur");
		exit();
		}
	
	switch($Option)
		{
		/* Une seule valeur � retourner */
		case "VAL":
			$Resultat = mysqli_fetch_row($SQL);
			$Return = $Resultat[0];
			break;
		
		/* Array unidimensionnel horizontal � retourner */
		case "ARR":
			$Resultat = mysqli_fetch_assoc($SQL);
			$Return = $Resultat;
			break;
		
		/* Array unidimensionnel vertical � retourner */
		case "LST":
			$Resultat = array();
			while ($Temp = mysqli_fetch_row($SQL)) { $Resultat[] = $Temp[0]; }
			$Return = $Resultat;
			break;
		
		/* Array bidimensionnel � retourner */
		case "TAB":
			$Resultat = array();
			while ($Temp = mysqli_fetch_assoc($SQL)) { $Resultat[] = $Temp; }
			$Return = $Resultat;
			break;
		
		/* Requete d'�x�cution */
		case "EXE":
			$Return = $Affectes;
			break;
		
		/* Requete brute */
		case "BRT":
			$Return = $SQL;
			break;
		
		default: exit("Option SQL inconnue");
		}
	
	/* Return */
	return $Return;
	}

?>
