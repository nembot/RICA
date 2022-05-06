<?php

function nonLus_lecture( $Messages )
	{
	/* Marque comme lus les messages, renvoit les lus */
	if (isset($_COOKIE['nouveaux']))
		{
		/* Chargement */
		$nouveaux = "-".$_COOKIE['nouveaux']."-";
		$News = array();
		
		/* Nettoyage */
		foreach($Messages as $M)
			{
			if (preg_match("#\-".$M['IDm']."\-#", $nouveaux))
				{
				$nouveaux = preg_replace("#\-".$M['IDm']."\-#", "-", $nouveaux);
				$News[] = $M['IDm'];
				}
			}
		
		/* Stockage */
		$nouveaux = substr($nouveaux, 1, -1);
		fonction("cookie", array("nouveaux", $nouveaux));
		
		/* Nouveaux messages */
		return $News;
		}
	else
		{ return array(); }
	}

?>
