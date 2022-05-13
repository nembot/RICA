<?php

function fonction($Nom, $Arguments=array()) {
	/* Require */
	if (!function_exists($Nom)) {
		if (file_exists("php/".$Nom.".php")) {
			require_once("php/".$Nom.".php");
		} else {
			die("Fonction \"".$Nom."\" inconnue\n");
		}
	}
	
	/* Appel */
	return call_user_func_array($Nom, $Arguments);
}

?>
