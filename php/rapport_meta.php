<?php

function rapport_meta( $Array, $Texte )
	{
	/* Objet */
	if (preg_match("#Votre flotte attaque la (?:flotte|plan[eéè]te)[ §]+(.*?) ?\(([PF])([0-9]+)\)#", $Texte, $Matches))
		{
		$Array['numero'] = $Matches[2].$Matches[3];
		$Array['nom'] = $Matches[1];
		if ($Matches[2] == "F")		{ $Array['objet'] = "Flotte"; }
		else if ($Matches[2] == "P")
			{
			if ($Matches[3] < 100)	{ $Array['objet'] = "Centre d'influence"; }
			else					{ $Array['objet'] = "Planète"; }
			}
		$Array['type'] = "Rapport d'attaque";
		}
	else if (preg_match("#se fait attaquer par la flotte de (.*?) \[X[0-9]+#", $Texte, $Matches))
		{
		$Array['numero'] = "<span class='inconnu'>Numero</span>";
		$Array['nom'] = "<span class='inconnu'>Nom</span>";
		$Array['objet'] = "Flotte";
		$Array['type'] = "Rapport de défense";
		}

	/* Cible */
	preg_match("#Vous avez d[eé]truit [0-9,]+ unit[eé]s à ([^§]+)#", $Texte, $Matches);
	$Array['cible'] = $Matches[1];
	$Array['cible'] = preg_replace("#\*#", "&#42;", $Array['cible']);
	
	/* Coordonnées */
	preg_match("#\[X([0-9]+)/Y(\-[0-9]+)\]#", $Texte, $Matches);
	$Array['position'] = $Matches[1]."/".$Matches[2];
	$Array['secteur'] = fonction("secteur", array($Matches[1], $Matches[2]));
	
	/* Passagers */
	$Split = preg_split("#(Vos Unités|Unités Ennemies)#", $Texte, -1, PREG_SPLIT_DELIM_CAPTURE);
	for($i=1;$i<count($Split);$i++)
		{
		if (preg_match("#Passager\(s\): ([^§]+)§#", $Split[$i], $Matches))
			{
			$VIP = preg_split("#, #", $Matches[1]);
			if ($Split[$i-1] == "Vos Unités")			{ $Array['VIP_allie'] = $VIP;; }
			else if ($Split[$i-1] == "Unités Ennemies")	{ $Array['VIP_ennemi'] = $VIP;; }
			}
		}
	
	/* Bilan */
	    if (preg_match("#Vous (avez gagn[eé]|gagnez) 1 point(s?) d'exp[eé]rience#", $Texte))	{ $Array['bilan'] = "Défaite"; }
	elseif (preg_match("#Vous avez r[eé]cup[eé]r[eé] la plan[eè]te#", $Texte))				{ $Array['bilan'] = "Capture"; }
	elseif (preg_match("#Vous avez d[eé]truit la flotte ennemie !#", $Texte))				{ $Array['bilan'] = "Destruction"; }
	elseif (preg_match("#Vous remportez le (combat)|(si[eè]ge) !!#", $Texte))				{ $Array['bilan'] = "Victoire"; }
	elseif (preg_match("#se fond dans la foule et dispara[iî]t [aà] jamais !!!#", $Texte))	{ $Array['bilan'] = "Meurtre"; }

	return $Array;
	}

?>
