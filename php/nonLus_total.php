<?php

function nonLus_total()
	{
	/* Renvoit le nombre de messages non lus */
	if (isset($_COOKIE['nouveaux']))
		{
		$NonLus = preg_split("#\-#", $_COOKIE['nouveaux']);
		$N = count($NonLus);
		}
	else { $N = 0; }
	
	return $N;
	}

?>
