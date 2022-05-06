<?php

function rapport_format( $Array, $Texte )
	{
	/* En-tête unités */
	$Pattern = "#(Vos Unités|Unités Ennemies) (Etat actuel) (Vie) (Dommages)§#";
	$Replace  = "<table class='rapport'><tr>";
	$Replace .= "<th colspan=2>$1</th>";
	$Replace .= "<th class='fixe'>$2</th>";
	$Replace .= "<th class='fixe'>$3</th>";
	$Replace .= "<th class='fixe'>$4</th>";
	$Replace .= "<th class='fixe'>Survivants</th>";
	$Replace .= "</tr>";
	$Texte = preg_replace($Pattern, $Replace, $Texte);

	/* En-tête bilan */
	$Pattern = "#(Bilan)§#";
	$Replace = "§§<div class='bilan'>$1</div>";
	$Texte = preg_replace($Pattern, $Replace, $Texte);

	/* Incrustation des dés attaquant */
	if (isset($Array['moi']))
		{
		foreach($Array['moi'] as $U => $V)
			{
			$Pattern = '#([>§])('.$V['id'].')\. ([^§]+) ([0-9,]+) ([0-9\.]+)( \+ [0-9\.]+)? ([0-9\.]+)( \+ [0-9\.]+)?§#';
			$Replace = '$1<tr>';
			$Replace .= '<td class="mini">$2</td>';
			
			if ($V['bonus'] != "" AND $V['passager']) { $Replace .= '<td>'.$U.'<br>('.$V['bonus'].' + Passager)</td>'; }
			else if ($V['bonus'] != "")               { $Replace .= '<td>'.$U.'<br>('.$V['bonus'].')</td>'; }
			else if ($V['passager'])                  { $Replace .= '<td>'.$U.'<br>(Passager)</td>'; }
			else                                      { $Replace .= '<td>'.$U.'</td>'; }
			
			$Replace .= '<td>$4</td>';
			$Replace .= '<td>$5$6 ('.round($V['vie-chance']).'%)</td>';
			$Replace .= '<td>$7$8 ('.round($V['deg-chance']).'%)</td>';
			
			if (isset($V['reste']))	{ $Replace .= '<td>~ '.$V['reste'].'</td>'; }
			else					{ $Replace .= '<td>incalculable</td>'; }
			
			$Replace .= '</tr>';
			
			$Texte = preg_replace($Pattern, $Replace, $Texte);
			}
		}

	/* Incrustation des dés défenseur */
	if (isset($Array['lui']))
		{
		foreach($Array['lui'] as $U => $V)
			{
			$Pattern = '#([>§])('.$V['id'].')\. ([^§]+) (\?) ([0-9\.]+)( \+ [0-9\.]+)? ([0-9\.]+)( \+ [0-9\.]+)?§#';
			$Replace = '$1<tr>';
			$Replace .= '<td class="mini">$2</td>';
			
			if ($V['bonus'] != "" AND $V['passager']) { $Replace .= '<td>'.$U.'<br>('.$V['bonus'].' + Passager)</td>'; }
			else if ($V['bonus'] != "")               { $Replace .= '<td>'.$U.'<br>('.$V['bonus'].')</td>'; }
			else if ($V['passager'])                  { $Replace .= '<td>'.$U.'<br>(Passager)</td>'; }
			else                                      { $Replace .= '<td>'.$U.'</td>'; }
			
			if (isset($V['reste']))	{ $Replace .= '<td>~ '.($V['reste']+$V['perdus']).'</td>'; }
			else					{ $Replace .= '<td>incalculable</td>'; }
			
			$Replace .= '<td>$5$6 ('.round($V['vie-chance']).'%)</td>';
			$Replace .= '<td>$7$8 ('.round($V['deg-chance']).'%)</td>';
			
			if (isset($V['reste']))	{ $Replace .= '<td>~ '.$V['reste'].'</td>'; }
			else					{ $Replace .= '<td>incalculable</td>'; }
			
			$Replace .= "</tr>";
			$Texte = preg_replace($Pattern, $Replace, $Texte);
			}
		}

	/* Fins de tableaux */
	$Texte = preg_replace("#</tr>(?!<tr>)#", "</tr></table>", $Texte);
	
	/* Passagers */
	$Texte = preg_replace("#(Passager\(s\)): ([^§]+)§#", "<table class='rapportVIP'><tr><th>$1</th><td>$2</td></tr></table>", $Texte);
	
	/* Sauts de ligne */
	$Texte = preg_replace("#§#", "\n", $Texte);
	$Texte = preg_replace("#\n \n#", "\n", $Texte);
	$Texte = preg_replace("#(Resultat du combat Terrestre)#", "", $Texte);
	$Texte = preg_replace("#(Vos (?!Unit))#", "\n$1", $Texte);
	$Texte = preg_replace("#(Les )#", "\n$1", $Texte);
	$Texte = preg_replace("#(La riposte des)#", "\n$1", $Texte);
	$Texte = preg_replace("#(L'attaque de)#", "\n$1", $Texte);
	$Texte = preg_replace("#\n#", "\n<br>", $Texte);

	return $Texte;
	}

?>
