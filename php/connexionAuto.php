<?php

function connexionAuto()
	{
	if (!isset($_SESSION['pseudo']) AND isset($_COOKIE['connexionAuto']))
		{
		if (preg_match("#^([0-9]+)\-([a-z0-9]+)$#", $_COOKIE['connexionAuto'], $Matches))
			{
			$Identite = $Matches[1];
			$Pass = $Matches[2];
			fonction("connexion", array($Identite, $Pass));
			}
		else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Cookie d'auto-connexion corrompu"); }
		}
	}

?>
