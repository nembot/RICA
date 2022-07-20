<?php

function affUnites()
	{
	$Unites = fonction("unites");
	$Donnees = "";

	$Donnees .= "\n\t\t<div id=\"body\">";
	$Donnees .= "\n\t\t\t<table class=\"unites\">";

	$Donnees .= "\n\t\t\t\t<tr>";
	$Donnees .= "\n\t\t\t\t\t<th>&nbsp;ID&nbsp;</th>";
	$Donnees .= "\n\t\t\t\t\t<th>&nbsp;T&nbsp;</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Noms complets</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Puissance</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Rech.</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Recrut.</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Vie</th>";
	$Donnees .= "\n\t\t\t\t\t<th>Dégats</th>";
	$Donnees .= "\n\t\t\t\t</tr>";

	$N = 1; while($N <= 18)
		{
		$U = $Unites[$N];

		$Donnees .= "\n\t\t\t\t<tr>";

		$Donnees .= "\n\t\t\t\t\t<td>".$U['N']."</td>";
		$Donnees .= "\n\t\t\t\t\t<td>".$U['T']."</td>";

		$Donnees .= "\n\t\t\t\t\t<td>";
		$Donnees .= "<span class=\"Contrebande\">".$U['C']."</span><br>";
		$Donnees .= "<span class=\"Empire\">".$U['E']."</span><br>";
		$Donnees .= "<span class=\"Rebellion\">".$U['R']."</span><br>";
		$Donnees .= "</td>";

		$Donnees .= "\n\t\t\t\t\t<td>".$U['Puissance']."</td>";
		$Donnees .= "\n\t\t\t\t\t<td>".$U['Recherche']."</td>";
		$Donnees .= "\n\t\t\t\t\t<td>".$U['taux']."</td>";
		$Donnees .= "\n\t\t\t\t\t<td>".$U['Vie-min']." à ".$U['Vie-max']." + ".$U['Vie-add']."</td>";
		$Donnees .= "\n\t\t\t\t\t<td>".$U['Deg-min']." à ".$U['Deg-max']." + ".$U['Deg-add']."</td>";

		$Donnees .= "\n\t\t\t\t</tr>";

		$N++;
		}
	$Donnees .= "\n\t\t\t</table>";
	$Donnees .= "\n\t\t</div>";

	return $Donnees;
	}

?>
