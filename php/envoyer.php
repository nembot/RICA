<?php

function envoyer($Get=TRUE)
	{
	/* Type d'envoi */
	if (isset($_POST['combat']))
		{
		$Parse = fonction("rapport", array( stripslashes($_POST['combat']), $Get ));
		$Type = "Rapport enregistré";
		}
	elseif (isset($_POST['carte']))
		{
		$Parse = fonction("carte", array( stripslashes($_POST['carte']) ));
		$Type = "Carte enregistrée";
		}
	elseif (isset($_POST['memo']))
		{
		$Parse = fonction("memo",
			array(
				stripslashes($_POST['titre']),
				stripslashes($_POST['joueur']),
				stripslashes($_POST['x']),
				stripslashes($_POST['y']),
				stripslashes($_POST['secteur']),
				stripslashes($_POST['type']),
				stripslashes($_POST['nom']),
				stripslashes($_POST['numero']),
				stripslashes($_POST['details'])
				)
			);
		$Type = "Memo enregistré";
		}
	
	if (isset($Type) AND $Parse !== FALSE)
		{
		/* Concaténation */
		$Ligne = "";
		foreach($Parse['elements'] as $C)
			{
			if (isset($C['nom']) AND $C['nom'] != "") { $Ligne .= "§".$C['nom']." : ".$C['contenu']; }
			else                                      { $Ligne .= "§".$C['contenu']; }
			}
		$Ligne = substr($Ligne, 1);
		
		/* Date */
		if ($_POST['date'] == "" OR preg_match("#\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}(:\d{2})?#", $_POST['date'], $M))
			{
			/* Date par défaut */
			if ($_POST['date'] == "") { $Date = date("Y-m-d H:i:s"); }
			else                      { $Date = $M[0]; }
			
			if (fonction("temps", array("TvS", $Date)) <= time() + 60*5)
				{
				/* Textes compressés */
				if ($Parse['original'] != "") { $Original = "FROM_BASE64(\"".base64_encode(gzcompress($Parse['original']))."\")"; }
				else                          { $Original = "NULL"; }
				if ($Parse['joint'] != "") { $Joint = "FROM_BASE64(\"".base64_encode(gzcompress($Parse['joint']))."\")"; }
				else                       { $Joint = "NULL"; }
				
				/* Requête SQL */
				$S = fonction("SQL",
					array("INSERT INTO entrees SET
						IDe = \"\",
						IDs = \"".$_SESSION['identite']."\",
						clan = \"".$_SESSION['clan']."\",
						date = \"".$Date."\",
						original = ".$Original.",
						elements = \"".addslashes($Ligne)."\",
						joint = ".$Joint."
						",__LINE__,"EXE",__FILE__
						)
					);
				
				/* Dialogue */
				if ($S == 1) { $GLOBALS['dialogues'][] = array("type" => "confirmation", "message" => $Type); }
				else         { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Echec de l'envoi"); }
			
				/* Redirection */
				$GLOBALS['body'] = "recherche";
				}
			else
				{
				$Date = FALSE;
				$GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Date entrée supérieure à la date actuelle");
				}
			}
		else
			{
			$Date = FALSE;
			$GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Format de date incorrect : aaaa-mm-jj hh:nn(:ss)");
			}
		}
	}

?>
