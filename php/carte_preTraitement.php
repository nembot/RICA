<?php

function carte_preTraitement( $Texte )
	{
	/* Extraction de la carte */
	$Texte = preg_split("#<table class=\"FightView\" align=\"center\">#", $Texte);
	$Texte = preg_split("#<\!\-\- /BLOC PAGE\-\->#", $Texte[1]);
	$Texte = preg_split("#<form method=\"post\" action=\"war.php\">#", $Texte[0]);
	$Texte = $Texte[0];

	/* Sauts de ligne */
	$Texte = preg_replace("#\n#", "", $Texte);
	$Texte = preg_replace("#\r#", "", $Texte);
	$Texte = preg_replace("#\t#", "", $Texte);
	$Texte = preg_replace("# +#", " ", $Texte);
	$Texte = preg_replace("#\> \<#", "><", $Texte);

	return $Texte;
	}

?>
