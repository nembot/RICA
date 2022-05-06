<?php

function nonLus_get()
	{
	/* Récupère les nouveaux messages non lus */
	if (isset($_COOKIE['lastCheck']) AND preg_match("#^[0-9]{4}(\-[0-9]{2}){5}$#", $_COOKIE['lastCheck']))
		{
		/* ID des nouveaux messages */
		$Nouveaux = fonction("SQL",
			array("SELECT IDm FROM messages WHERE date > \"".$_COOKIE['lastCheck']."\"",__LINE__,"LST",__FILE__)
			);
		
		if (count($Nouveaux) > 0)
			{
			/* ID des anciens messages */
			if (isset($_COOKIE['nouveaux']))	{ $nouveaux = $_COOKIE['nouveaux']."-"; }
			else								{ $nouveaux = ""; }
		
			/* Stockage */
			$nouveaux .= implode("-", $Nouveaux);
			fonction("cookie", array("nouveaux", $nouveaux));
			}
		}
	
	/* Date de check */
	$lastCheck = fonction("temps", array("SvT", time(), "cookie"));
	fonction("cookie", array("lastCheck", $lastCheck));
	}

?>
