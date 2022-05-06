<?php

function hacher( $Chaine )
	{
	$SelA = "57jH6g4t7g8s";
	$SelB = "tG6ShD85f2G8";
	$Sortie = base_convert(md5($SelA.$Chaine.$SelB, FALSE),  16,  36);
	
	return $Sortie;
	}

?>
