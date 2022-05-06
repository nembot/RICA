<?php

function affVIP_html( $VIP )
	{
	$Sortie = "";
	
	/* En-tete */	
	$Sortie .= "\n\t\t\t<table class=\"vip\">";
	$Sortie .= "\n\t\t\t\t<tr>";
	$Sortie .= "\n\t\t\t\t\t<th><b>Passager</b><br>(Rechercher)</th>";
	$Sortie .= "\n\t\t\t\t\t<th><b>Joueur</b><br>(Fiche)</th>";
	$Sortie .= "\n\t\t\t\t\t<th><b>Sur</b><br>(Rechercher)</th>";
	$Sortie .= "\n\t\t\t\t\t<th><b>Il y a</b><br>(Rapport)</th>";
	$Sortie .= "\n\t\t\t\t\t<th><b>Localisation</b></th>";
	$Sortie .= "\n\t\t\t\t</tr>";

	/* Contenu */
	$T = -1;
	foreach($VIP as $N => $V)
		{
		if ($V['T'] != $T)
			{
			$T = $V['T'];
			$Sortie .= "<tr><td colspan=5 class=\"separateur\">Technologie ".$T."</td></tr>";
			}
		
		$Sortie .= "\n\t\t\t\t<tr>";
		$Sortie .= "\n\t\t\t\t\t<td><a href=\"index.php?R=".$N."\" class=\"".$V['clan']."\" target=\"_blank\">".$N."</a></td>";
		if (isset($V['IDe']))
			{
			$Sortie .= "\n\t\t\t\t\t<td><a href=\"".$V['Fiche']."\" class=\"".$V['JClan']."\" target=\"_blank\">".$V['Joueur']."</a></td>";
			
			if (preg_match("#\(([FP][0-9]+)\)#", $V['Objet'], $Matches))
				{
				$Arg = urlencode($V['Type']." : ".preg_replace("# \([FP][0-9]+\)#", "", $V['Objet']));
				$Sortie .= "\n\t\t\t\t\t<td><a href=\"index.php?R=".$Arg."\" target=\"_blank\">".$V['Objet']."</a></td>";
				}
			else { $Sortie .= "\n\t\t\t\t\t<td>".$V['Objet']."</td>"; }
			
			$Stamp = fonction("temps", array("TvS", $V['Date']));
			$Sortie .= "\n\t\t\t\t\t<td><a href=\"joint.php?E=".$V['IDe']."\" target=\"_blank\">";
			$Sortie .= fonction("interval", array($Stamp));
			$Sortie .= "</a></td>";
			
			$Sortie .= "\n\t\t\t\t\t<td>".$V['Position']." (".$V['Secteur'].")</td>";
			}
		else
			{
			$Sortie .= "\n\t\t\t\t\t<td></td>";
			$Sortie .= "\n\t\t\t\t\t<td></td>";
			$Sortie .= "\n\t\t\t\t\t<td></td>";
			$Sortie .= "\n\t\t\t\t\t<td></td>";
			}
		$Sortie .= "\n\t\t\t\t</tr>";
		}
		
	$Sortie .= "\n\t\t\t</table>";
	
	return $Sortie;
	}

?>
