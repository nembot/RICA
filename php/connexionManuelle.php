<?php

function connexionManuelle()
	{
	if (isset($_POST['connexion']))
		{
		if (isset($_POST['identite']) AND preg_match("#^[0-9]+$#", $_POST['identite']))
			{
			if (isset($_POST['pass']) AND $_POST['pass'] != "")
				{
				$Identite = $_POST['identite'];
				$Pass = fonction("hacher", array($_POST['pass']));
				fonction("connexion", array($Identite, $Pass));
				}
			else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Entrez votre mot de passe"); }
			}
		else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Choisissez votre identité"); }
		}
	}

?>
