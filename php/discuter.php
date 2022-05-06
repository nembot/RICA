<?php

function discuter()
	{
	if (isset($_POST['discuter']))
		{
		if ($_POST['titre'] != "")
			{
			$Type = "nouveau";
			$Titre = fonction("signes", array($_POST['titre']));
			if ($Titre != "")
				{
				$Conversation = fonction("SQL",
					array("INSERT INTO conversations SET
						IDc = \"\",
						titre = \"".$Titre."\"
						",__LINE__,"EXE",__FILE__
						)
					);
				if ($Conversation == 1)
					{
					$GLOBALS['dialogues'][] = array("type" => "confirmation", "message" => "Nouveau sujet créé");
					$IDc = fonction("SQL", array("SELECT last_insert_id()",__LINE__,"VAL",__FILE__));
					}
				else	{ $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Echec de la création du sujet"); }
				}
			else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Titre de nouveau sujet invalide"); }
			}
		
		/* Sujet auquel répondre */
		if (isset($_GET['C']) AND $_POST['titre'] == "")
			{
			$Type = "repondre";
			$IDc = $_GET['C'];
			}
		
		/* Message d'erreur */
		if (!isset($Type))
			{ $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Ouvrez un sujet auquel répondre ou créez en un"); }
		
		/* Nouveau message */
		if (isset($IDc))
			{
			if (preg_match("#^[0-9]+$#", $IDc))
				{
				/* Mise en forme */
				$Message = fonction("signes", array($_POST['discuter']));
				$Message = preg_replace("#\n#", "<br>", $Message);
				$Message = preg_replace("#(<br>)+$#", "", $Message);
				$Message = preg_replace("#^(<br>)+#", "", $Message);
				
				/* Envoi */
				$Message = fonction("SQL",
					array("INSERT INTO messages SET
						IDm = \"\",
						IDc = \"".$IDc."\",
						IDs = \"".$_SESSION['identite']."\",
						date = NOW(),
						message = \"".$Message."\"
						",__LINE__,"EXE",__FILE__
						)
					);
				if ($Message == 1)
					{ $GLOBALS['dialogues'][] = array("type" => "confirmation", "message" => "Message envoyé"); }
				else	{ $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Echec de l'envoi du message"); }
				}
			else	{ $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Identifiant de sujet invalide"); }
			}
		}
	}

?>
