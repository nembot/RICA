<?php

// Wrapper
function temps($Type, $Entree, $Format="")
	{
	switch($Type)
		{
		/* Temps SQL */
		case "TvS": return temps_tvs($Entree); break;
		case "TvD": return temps_tvd($Entree, $Format); break;
		
		/* Temps intuitif */
		case "IvS": return temps_ivs($Entree); break;
		case "IvT": return temps_ivt($Entree); break;
		case "IvD": return temps_ivd($Entree, $Format); break;
		
		/* Timestamp */
		case "SvT": return temps_svt($Entree, $Format); break;
		case "SvD": return temps_svd($Entree, $Format); break;
		}
	}

// Temps sql Vers timeStamp
function temps_tvs( $Entree )
	{
	if (
		preg_match("#^([0-9]{4}).([0-9]{2}).([0-9]{2}).([0-9]{2}).([0-9]{2})(?:.([0-9]{2}))?$#", $Entree, $H)
		AND !preg_match("#^0{4}.0{2}.0{2}.0{2}.0{2}(.0{2})?$#", $Entree)
		)
			{ return mktime( $H[4], $H[5], $H[6], $H[2], $H[3], $H[1] ); }
	else	{ return FALSE; }
	}

// Temps sql vers Date formattée
function temps_tvd($Entree, $Format)
	{
	$Entree = temps_tvs($Entree);
	if ($Entree !== FALSE)
		{
		$Entree = temps_svd($Entree, $Format);
		if ($Entree !== FALSE)	{ return $Entree; }
		else					{ return FALSE; }
		}
	else { return FALSE; }
	}

// temps Intuitif vers timeStamp
function temps_ivs( $Entree )
	{
	if (
		preg_match("#^([0-9]{2})/([0-9]{2})/([0-9]{2}) ([0-9]{2}):([0-9]{2})(?:\:([0-9]{2}))?$#", $Entree, $H)
		AND !preg_match("#^0{2}/0{2}/0{2} 0{2}:0{2}(?:\:(0{2}))?$#", $Entree)
		)
			{ return mktime( $H[4], $H[5],$H[6], $H[2], $H[1], $H[3] ); }
	else	{ return FALSE; }
	}

// temps Intuitif vers Temps sql
function temps_ivt($Entree)
	{
	$Entree = temps_ivs($Entree);
	if ($Entree !== FALSE)
		{
		$Entree = temps_svt($Entree);
		if ($Entree !== FALSE)	{ return $Entree; }
		else					{ return FALSE; }
		}
	else { return FALSE; }
	}	
	
// temps Intuitif vers Date formattée
function temps_ivd($Entree, $Format)
	{
	$Entree = temps_ivs($Entree);
	if ($Entree !== FALSE)
		{
		$Entree = temps_svd($Entree, $Format);
		if ($Entree !== FALSE)	{ return $Entree; }
		else					{ return FALSE; }
		}
	else { return FALSE; }
	}

// timeStamp Vers Temps sql
function temps_svt( $Entree, $Format="strict" )
	{
	if ($Format == "strict")
		{
		if (preg_match("#^[0-9]+$#", $Entree) AND $Entree != 0)
				{ return date("Y/m/d H:i:s", $Entree); }
		else	{ return FALSE; }
		}
	else if ($Format == "cookie")
		{
		if (preg_match("#^[0-9]+$#", $Entree) AND $Entree != 0)
				{ return date("Y-m-d-H-i-s", $Entree); }
		else	{ return FALSE; }
		}
	else	{ return FALSE; }
	}

// timeStamp vers Date formattée
function temps_svd($Entree, $Format)
	{
	if (preg_match("#^[0-9]+$#", $Entree) AND $Entree != 0)
		{
		$Pattern = array(
			"/#N2/", /* Numéro de jour sur 2 chiffres */
			"/#J3/", /* Jour sur 3 lettres */
			"/#Jc/", /* Jour en lettres */
			"/#J1/", /* Jour sur 1 chiffre */
			"/#M2/", /* Mois sur 2 chiffres */
			"/#M3/", /* Mois sur 3 lettres */
			"/#Mc/", /* Mois en lettres */
			"/#A2/", /* Année sur 2 chiffres */
			"/#A4/", /* Année sur 4 chiffres */
			"/#H2/", /* Heure sur 2 chiffres (24) */
			"/#I2/", /* Minutes sur 2 chiffres */
			"/#S2/"  /* Secondes sur 2 chiffres */
			);
		
		$Replace = array(
			date("d", $Entree),
			datefr("#J3", $Entree),
			datefr("#Jc", $Entree),
			date("N", $Entree),
			date("m", $Entree),
			datefr("#M3", $Entree),
			datefr("#Mc", $Entree),
			date("y", $Entree),
			date("Y", $Entree),
			date("H", $Entree),
			date("i", $Entree),
			date("s", $Entree)
			);
		
		return preg_replace( $Pattern, $Replace, $Format );
		}
	else { return FALSE; }
	}

// Traduction francaise des mois et jours de date
function datefr( $Type, $Stamp )
	{
	$J3 = array("", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim");
	$Jc = array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
	$M3 = array("", "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec");
	$Mc = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre");
	
	switch($Type)
		{
		case "#J3": return $J3[ date("N", $Stamp) ]; break;
		case "#Jc": return $Jc[ date("N", $Stamp) ]; break;
		case "#M3": return $M3[ date("n", $Stamp) ]; break;
		case "#Mc": return $Mc[ date("n", $Stamp) ]; break;
		default: die("Type de datefr inconnu");
		}
	}

?>
