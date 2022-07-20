<?php

function affVIP_bbc( $VIP )
	{
	$Sortie = "";

	/* Interface */
	$Sortie .= "<div class=\"aide\">Cliquez dans la zone de texte, tappez Ctrl + A pour tout sélectionner puis Ctrl + C pour copier.<br>Dans votre message de forum, tapez Ctrl + V pour coller les informations formattées sur les VIP</div>";
	$Sortie .= "<textarea rows=1 cols=1 id=\"BBCode\">";

	/* Contenu */
	$T = -1;
	foreach($VIP as $N => $V)
		{
		if ($V['T'] != $T)
			{
			$T = $V['T'];
			$Sortie .= "\n[size=117][color=orange][b]Technologie ".$T."[/b][/color][/size]\n";
			}

		$Sortie .= ":arrow: [b]".fonction("BBClan", array($N, $V['clan']))."[/b]";

		if (isset($V['IDe']))
			{
			$Sortie .= " :arrow: ".fonction("BBClan", array($V['Joueur'], $V['JClan']));
			$Sortie .= " le ".fonction("temps", array("TvD", $V['Date'], "#N2/#M2"));
			$Sortie .= " en [url=http://rica.ovsa.fr/joint.php?E=".$V['IDe']."]".$V['Position']." (".$V['Secteur'].")[/url]";
			}

		$Sortie .= "\n";
		}

	$Sortie .= "\nGénéré par [url=http://rica.ovsa.fr]RICA[/url] pour le clan \"".$_SESSION['clan']."\" le ".date("d/m/Y à H:i:s");

	$Sortie .= "</textarea>";

	return $Sortie;
	}

?>
