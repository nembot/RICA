<?php

function affBonus()
	{
	$Brut = fonction("bonus");
	$Unites = fonction("unites");
	$Bonus = "";

	/* En-tete de page */
	$Bonus .= "\n\t\t<div id=\"body\">";

	/* Mon clan si non renseigné */
	if (isset($_POST['moi']))		{ $Moi = $_POST['moi']; }
	else if (isset($_SESSION['clan']))	{ $Moi = $_SESSION['clan']; }
	else							{ $Moi = "Empire"; }

	/* Son clan si non renseigné */
	if (isset($_POST['lui']))		{ $Lui = $_POST['lui']; }
	else if (isset($_SESSION['clan']))
		{
		switch($_SESSION['clan'])
			{
			case "Contrebande":	$Lui = "Empire"; break;
			case "Empire":		$Lui = "Rebellion"; break;
			case "Rebellion":	$Lui = "Empire"; break;
			default:			die("Clan inconnu");
			}
		}
	else { $Lui = "Rebellion"; }

		/* Selected et vérification */
	switch($Moi)
		{
		case "Contrebande":	$Mc = " selected"; $Me = ""; $Mr = ""; $Mn = ""; break;
		case "Empire":		$Mc = ""; $Me = " selected"; $Mr = ""; $Mn = ""; break;
		case "Rebellion":	$Mc = ""; $Me = ""; $Mr = " selected"; $Mn = ""; break;
		case "Numero":          $Mc = ""; $Me = ""; $Mr = ""; $Mn = " selected"; break;
		default:			die("Clan inconnu");
		}
	switch($Lui)
		{
		case "Contrebande":	$Lc = " selected"; $Le = ""; $Lr = ""; $Lr = ""; break;
		case "Empire":		$Lc = ""; $Le = " selected"; $Lr = ""; $Lr = ""; break;
		case "Rebellion":	$Lc = ""; $Le = ""; $Lr = " selected"; $Lr = ""; break;
		case "Numero":          $Lc = ""; $Le = ""; $Lr = ""; $Lr = " selected"; break;
		default:			die("Clan inconnu");
		}

	/* Formulaire */
	$Bonus .= "<form action=\"\" method=\"post\" id=\"bonus\">";
	$Bonus .= "Une unité <select name=\"moi\">";
	$Bonus .= "<option value=\"Contrebande\"".$Mc.">contrebandière";
	$Bonus .= "<option value=\"Empire\"".$Me.">impériale";
	$Bonus .= "<option value=\"Rebellion\"".$Mr.">rebelle";
	$Bonus .= "<option value=\"Numero\"".$Mn.">numérotée";
	$Bonus .= "</select>";
	$Bonus .= " attaque une unité <select name=\"lui\">";
	$Bonus .= "<option value=\"Contrebande\"".$Lc.">contrebandière";
	$Bonus .= "<option value=\"Empire\"".$Le.">impériale";
	$Bonus .= "<option value=\"Rebellion\"".$Lr.">rebelle";
	$Bonus .= "<option value=\"Numero\"".$Ln.">numérotée";
	$Bonus .= "</select>";
	$Bonus .= "<input type=\"submit\" class=\"submit\" value=\"Actualiser\">";
	$Bonus .= "</form>";

	/* En-tete de tableau */
	$Bonus .= "\n\t\t\t<table class=\"bonus\">";

	/* Titres de colonnes */
	$Bonus .= "\n\t\t\t\t<tr>\n\t\t\t\t\t<td></td>";
	for($N=1;$N<=18;$N++)
		{
		$ID = strtolower(substr($Lui,0,1));
		if($Lui == "Numero") { $Unite = $N;
		} else               { $Unite = strtoupper(preg_replace("#(.)#", "$1<br>", $Unites[ $N ][ $ID ]));
		}
		$Bonus .= "\n\t\t\t\t\t<td class=\"vertical ".$Lui."\">".$Unite."</td>";
		}
	$Bonus .= "\n\t\t\t\t</tr>";

	/* Ligne par ligne */
	for($L=1;$L<=18;$L++)
		{
		$Bonus .= "\n\t\t\t\t<tr>";
		$ID = strtolower(substr($Moi,0,1));
		if($Moi == "Numero") { $Unite = $L;
                } else               { $Unite = $Unites[ $L ][ $ID ];
                }
		$Bonus .= "\n\t\t\t\t\t<td class=\"".$Moi."\">".$Unite."</td>";
		for($C=1;$C<=18;$C++)
			{
			$A = $Brut[ $L ][ $C ];
			$B = $Brut[ $C ][ $L ];
			$Bonus .= "\n\t\t\t\t\t<td class=\"bonus_".$A.$B."\"></td>";
			}
		$Bonus .= "\n\t\t\t\t</tr>";
		}

	/* Pied du tableau */
	$Bonus .= "\n\t\t\t</table>";

	/* L�gende */
	$Bonus .= "\n\t\t\t<table class=\"legende\">";
	$Bonus .= "\n\t\t\t\t<tr><td class=\"bonus_02\">Le défenseur a un double bonus</td></tr>";
	$Bonus .= "\n\t\t\t\t<tr><td class=\"bonus_01\">Le défenseur a un bonus</td></tr>";
	$Bonus .= "\n\t\t\t\t<tr><td class=\"bonus_11\">Bonus pour les 2 unités</td></tr>";
	$Bonus .= "\n\t\t\t\t<tr><td class=\"bonus_10\">L'Attaquant a un bonus</td></tr>";
	$Bonus .= "\n\t\t\t\t<tr><td class=\"bonus_20\">L'Attaquant a un double bonus</td></tr>";
	$Bonus .= "\n\t\t\t</table>";

	/* Pied de la page */
	$Bonus .= "\n\t\t</div>";

	return $Bonus;
	}
