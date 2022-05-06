<?php

function inscription()
	{
	if (isset($_POST['inscription']))
		{
		if (preg_match("#^[0-9]+$#", $_POST['identite']))
			{
			if ($_POST['pass'] != "")
				{
				$Multi = fonction("SQL", array("SELECT IDs FROM inscrits WHERE IDs=\"".$_POST['identite']."\"",__LINE__,"VAL",__FILE__));
				if ($Multi == "")
					{
					$Test = fonction("getPerso", array($_POST['identite'], "Check"));
					if ($Test['Check'] == 1)
						{
						fonction("SQL",
							array("INSERT INTO inscrits SET
								IDs = \"".$_POST['identite']."\",
								pass = \"".fonction("hacher", array($_POST['pass']))."\"
								",__LINE__,"EXE",__FILE__
								)
							);
						$GLOBALS['dialogues'][] = array("type" => "confirmation", "message" => "Vous pouvez vous connecter");
						}
					else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Votre identité n'a pas été confirmée"); }
					}
				else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Cette identité a déja été activée"); }
				}
			else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Choisissez un mot de passe"); }
			}
		else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Choisissez votre identité"); }
		}
	}

?>
