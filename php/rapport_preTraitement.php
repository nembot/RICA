<?php

function rapport_PreTraitement( $Texte )
	{
	/* Simplification */
	$Texte = stripslashes($Texte);
	$Texte = fonction("signes", array($Texte));
	$Texte = preg_replace("#\r#", "\n", $Texte);
	$Texte = preg_replace("#\t#", " ", $Texte);
	$Texte = preg_replace("#( ){2,}#", " ", $Texte);
	$Texte = preg_replace("#\n #", "\n", $Texte);
	$Texte = preg_replace("# \n#", "\n", $Texte);
	$Texte = preg_replace("#(\n){2,}#", "\n", $Texte);
	$Texte = preg_replace("#\n#", "§", $Texte);

	/* Puces */
	$Texte = preg_replace("/# /", "", $Texte);
	$Texte = preg_replace("/&#8226;/", "", $Texte);

	/* Début 1 */
	if (preg_match("#^.*(Vous b[eé]n[eé]ficiez de.+)$#", $Texte, $M))
		{ $T1 = $M[1]; } else { $T1 = ""; }

	/* Début 2 */
	preg_match("#Vous avez d[eé]truit [0-9,]+ unit[eé]s à ([^§]+)#", $Texte, $Matches);
	if (preg_match("#^.*(".preg_quote($Matches[1])." b[eé]n[eé]ficie de.+)$#", $Texte, $M))
		{ $T2 = $M[1]; } else { $T2 = ""; }

	/* Début 3 */
	if (preg_match("#^.*(Votre flotte attaque.+)$#", $Texte, $M))
		{ $T3 = $M[1]; } else { $T3 = ""; }

	/* Début 4 */
	if (preg_match("#^.*(Votre (flotte|plan[eéèê]te).*? \([FP][0-9]+\) se fait attaquer.+)$#", $Texte, $M))
		{ $T4 = $M[1]; } else { $T4 = ""; }

	/* Début le plus long */	
	$Tm = max( strlen($T1), strlen($T2), strlen($T3), strlen($T4) );
	if (strlen($T1) == $Tm)			{ $Texte = $T1; }
	else if (strlen($T2) == $Tm)	{ $Texte = $T2; }
	else if (strlen($T3) == $Tm)	{ $Texte = $T3; }
	else if (strlen($T4) == $Tm)	{ $Texte = $T4; }
	else							{ return FALSE; }

	/* Fin */
	$Texte = preg_replace("#(point(s?) d'exp[ée]rience).*$#", "$1", $Texte, 1, $Count);
	return $Texte;
	}


?>
