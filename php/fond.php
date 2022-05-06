<?php

function fond()
	{
	if (isset($_SESSION['clan']))	{ $Fond = $_SESSION['clan']; }
	else						{ $Fond = "Neutre"; }

	return $Fond;
	}

?>
