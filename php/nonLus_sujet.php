<?php

function nonLus_sujet( $Messages )
	{
	/* Nombre de messages non lus dans le sujet */
	if (isset($_COOKIE['nouveaux']))
		{
		$Messages = preg_split("#\-#", $Messages);
		$NonLus = preg_split("#\-#", $_COOKIE['nouveaux']);
		$News = array_intersect($Messages, $NonLus);
		
		return count($News);
		}
	else { return 0; }
	}

?>
