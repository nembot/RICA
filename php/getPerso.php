<?php

function getPerso( $IDs, $Type )
	{
	/* Récupération HTML */
	$Perso = file_get_contents("http://www.ngswing.com/infoperso.php?id1=".$IDs);
	if ($Perso !== FALSE AND preg_match("#<p>Fiche de perso </p>#", $Perso))
		{
		if ($Type == "Combat")
			{
			/* Extraction */
			preg_match("#<td>Tour jou&eacute;s :</td>[^<]+?<td>([0-9,]+)</td>#", $Perso, $Tours);
			$Tours = preg_replace("#,#", "", $Tours[1]);

			preg_match("#<td>Parsecs :</td>[^<]+?<td>([0-9,]+)</td>#", $Perso, $Parsecs);
			$Parsecs = preg_replace("#,#", "", $Parsecs[1]);

			preg_match("#<td>Planetes :</td>[^<]+?<td>([0-9]+)</td>#", $Perso, $Planetes);
			$Planetes = $Planetes[1];

			preg_match("#<td>Clan : </td>[^<]+?<td>(.*?)</td>#", $Perso, $Clan);
			$Clan = preg_replace("#é#", "e", $Clan[1]);

			return array("Tours" => $Tours, "Parsecs" => $Parsecs, "Planetes" => $Planetes, "Clan" => $Clan);
			}
		else if ($Type == "Check")
			{
			preg_match("#<td>Clan : </td>[^<]+?<td>(.*?)</td>#", $Perso, $Clan);
			$Clan = $Clan[1];
	
			$Check = preg_match("#Membre du Réseau RICA#", $Perso);
	
			return array("Check" => $Check, "Clan" => $Clan);
			}
		else { exit("Type pour getPerso() incorrect"); }
		}
	else { return FALSE; }
	}

?>
