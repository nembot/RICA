<?php

function rapport_joueur( $Array )
	{
	$Unites = fonction("unites");

	$Cible = fonction("SQL", array("SELECT IDs FROM classement WHERE pseudo=\"".$Array['cible']."\"",__LINE__,"VAL",__FILE__));

	/* Considérations locales */
	$Array['puissance'] = 0;
	$Inconnu = FALSE;
	if (isset($Array['lui']))
		{
		foreach($Array['lui'] as $U => $V)
			{
			if (!isset($V['reste']))	{ $Inconnu = TRUE; }
			else if ($V['reste'] > 0)	{ $Array['puissance'] += $Unites[ $U ]['Puissance'] * $V['reste']; }
			}
		}
	
	/* Données de SWING */
	if (!is_null($Cible))
		{
		$Array['IDs'] = $Cible;
	
		$Perso = fonction("getPerso", array($Cible, "Combat"));
		if ($Perso === FALSE)
			{
			/* Echec de la connexion */
			trigger_error("Echec de la connexion à SWING");
			}
		else
			{
			/* Récupération OK */
			$Array['tours'] = $Perso['Tours'];
			$Array['clan'] = $Perso['Clan'];
			$Array['parsecs'] = $Perso['Parsecs'];
			$Array['planetes'] = $Perso['Planetes'];
			}
		}
	else
		{
		/* Joueur pas dans classement local */
		trigger_error("Joueur absent du classement local");
		}
	
	$Array['inconnu'] = $Inconnu;
	
	return $Array;
	}
