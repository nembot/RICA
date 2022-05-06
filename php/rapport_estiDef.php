<?php

function rapport_estiDef( $Array, $Texte )
	{
	$Unites = fonction("unites");
	$Bonus = fonction("bonus");
	
	/* Liste des échanges de tirs */
	$Pattern = "#(Les|Vos) (?:([0-9,]+) )?([^§]+?) (?:ripostent et )?(attaquent|portent un coup critique)";
	$Pattern .= " (?:vos|les|[aà] vos|aux) ([0-9,]+ )?([^§]+?)";
	$Pattern .= "( avec un [eé]chec critique)?§([0-9,]+) [^§]+ ont été supprimés#";
	preg_match_all($Pattern, $Texte, $Matches);
	
	$N = 0;
	while(isset($Matches[0][$N]))
		{
		/* Traduction */
		if ($Matches[1][$N] == "Les")	{ $JAtt = "lui"; $JDef = "moi"; }
		else							{ $JAtt = "moi"; $JDef = "lui"; }
		$NAtt = preg_replace("#,#", "", $Matches[2][$N]);
		$UAtt = $Matches[3][$N];
		if ($Matches[4][$N] == "attaquent") { $Critique = 0; } else { $Critique = 1; }
		$NDef = preg_replace("#,#", "", $Matches[5][$N]);
		$UDef = $Matches[6][$N];
		if ($Matches[7][$N] == "") { $Echec = 0; } else { $Echec = 1; }
		$PDef = preg_replace("#,#", "", $Matches[8][$N]);

		/* Collecte */
		$Degats = $Array[ $JAtt ][ $UAtt ]['deg-des'];
		$Vie = $Array[ $JDef ][ $UDef ]['vie-des'];
		$Multi = $Bonus[ $Unites[ $UAtt ]['N'] ][ $Unites[ $UDef ]['N'] ];
		if (($Array['type'] == "Rapport d'attaque" AND $JAtt == "moi") OR ($Array['type'] == "Rapport de défense" AND $JAtt == "lui"))
			{ $Attaque = 1; } else { $Attaque = 0; }

		/* Nombre d'attaquants */
		if ($NAtt != "")	{ $Array[ $JAtt ][ $UAtt ]['reste'] = $NAtt; $Attaquants = ""; }
		else
			{
			$Attaquants = floor( ((($PDef-0.5)*floor($Vie))/floor($Degats))*(2+$Attaque*2)/(1+$Critique*0.5)/(1+$Multi*2)*(1+$Echec) );	
			$Array[ $JAtt ][ $UAtt ]['reste'] = $Attaquants;
			$NAtt = $Attaquants;
			}

		/* Unité exterminée */
		$Theorie = ceil( ($NAtt*floor($Degats) / floor($Vie)) /(2+$Attaque*2) *(1+$Multi*2) *(1+$Critique*0.5) /(1+$Echec) );
		if ($Theorie - $PDef > 2)								{ $Array[ $JDef ][ $UDef ]['reste'] = 0; }
		else if (isset($Array[ $JDef ][ $UDef ]['reste']))
			{
			$Array[ $JDef ][ $UDef ]['reste'] -= $PDef;
			if ($Theorie != $PDef)
				{
				if (isset($Array[ $JDef ][ $UDef ]['rustine']))	{ $Array[ $JDef ][ $UDef ]['rustine'] ++; }
				else											{ $Array[ $JDef ][ $UDef ]['rustine'] = 1; }
				}
			}	

		/* Vérifications
		echo "<pre>";
		print_r( array(
			"JAtt" => $JAtt,
			"JDef" => $JDef,
			"NAtt" => $NAtt,
			"UAtt" => $UAtt,
			"Critique" => $Critique,
			"NDef" => $NDef,
			"UDef" => $UDef,
			"Echec" => $Echec,
			"PDef" => $PDef,
			"Degats" => $Degats,
			"Vie" => $Vie,
			"Multi" => $Multi,
			"Attaque" => $Attaque,
			"Theorie" => $Theorie,
			"Attaquants" => $Attaquants
			) );
		echo "</pre>"; */

		$N++;
		}

	return $Array;
	}
