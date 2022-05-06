<?php

function rapport_des( $Array, $Texte )
	{
	$Unites = fonction("unites");
	$LoopJoueur = array(
		"moi",
		"lui"
		);
	$LoopUnites = array(
		"#[0-9]+\. ([^§]+?)(?: \(Bonus (Vie|Dégats)\))?( \(\*\))? ([0-9,]+) ([0-9\.]+)( \+ [0-9\.]+)? ([0-9\.]+)( \+ [0-9\.]+)?§#",
		"#[0-9]+\. ([^§]+?)(?: \(Bonus (Vie|Dégats)\))?( \(\*\))? (\?) " . "([0-9\.]+)( \+ [0-9\.]+)? ([0-9\.]+)( \+ [0-9\.]+)?§#"
		);
	$LoopPertes = array(
		"#Les [^§]+§([0-9,]+) ([^§]+) ont [eé]t[eé] supprim[eé]s#",
		"#Vos [^§]+§([0-9,]+) ([^§]+) ont [eé]t[eé] supprim[eé]s#"
		);

	$I = 0;
	while($I <= 1)
		{
		preg_match_all($LoopUnites[$I], $Texte, $Matches);
		$N=0; while( isset($Matches[0][$N]) )
			{
			$U = $Matches[1][$N];
			$Uni = $Unites[ $U ];
			
			/* Collecte */
			$Array[ $LoopJoueur[$I] ][$U] = array(
				"vie-min" => $Uni['Vie-min'] + $Uni['Vie-add'],
				"vie-max" => $Uni['Vie-max'] + $Uni['Vie-add'],
				"vie-des" => $Matches[5][$N] + substr($Matches[6][$N], 3),
				"deg-min" => $Uni['Deg-min'] + $Uni['Deg-add'],
				"deg-max" => $Uni['Deg-max'] + $Uni['Deg-add'],
				"deg-des" => $Matches[7][$N] + substr($Matches[8][$N], 3),
				"bonus" => $Matches[2][$N],
				"passager" => ($Matches[3][$N] != ""),
				"perdus" => 0,
				"taux" => $Uni['taux'],
				"id" => $Uni['N'],
				"nombre" => preg_replace("#,#", "", $Matches[4][$N])
				);
		
			/* Dés */
			$A = $Array[ $LoopJoueur[$I] ][$U];
			$Array[ $LoopJoueur[$I] ][$U]['vie-chance'] = 100 * ($A['vie-des'] - $A['vie-min']) / ($A['vie-max'] - $A['vie-min']);
			$Array[ $LoopJoueur[$I] ][$U]['deg-chance'] = 100 * ($A['deg-des'] - $A['deg-min']) / ($A['deg-max'] - $A['deg-min']);

			$N++;
			}

		/* Pertes (nombre) */
		preg_match_all($LoopPertes[$I], $Texte, $Matches);
		$N=0; while( isset($Matches[0][$N]) )
			{
			$U = $Matches[2][$N];
			$Array[ $LoopJoueur[$I] ][ $U ]['perdus'] += preg_replace("#,#", "", $Matches[1][$N]);
			$N++;
			}

		/* Pertes (tours) */
		if (isset($Array[ $LoopJoueur[$I] ]))
			{
			foreach($Array[ $LoopJoueur[$I] ] as $U => $V)
				{ $Array[ $LoopJoueur[$I] ][$U]['pertes'] = $V['perdus'] / $V['taux']; }
			}

		$I++;
		}
	
	return $Array;
	}

?>
