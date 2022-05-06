<?php

function affVIP()
	{
	$Sortie = "<div id=\"body\">";
	
	if (isset($_SESSION['pseudo']))
		{
		if (isset($_POST['typeVIP']) AND $_POST['typeVIP'] == "BBC")	{ $Type = "BBC"; $SBBC = " selected"; $SHTML = ""; }
		else													{ $Type = "HTML"; $SBBC = ""; $SHTML = " selected"; }
		
		$Sortie .= "<form action=\"\" method=\"post\">";
		$Sortie .= "<input type=\"submit\" class=\"submit\" value=\"Changer l'affichage\">";
		$Sortie .= "<select name=\"typeVIP\" id=\"typeVIP\">";
		$Sortie .= "<option value=\"HTML\"".$SHTML.">Consulter sur RICA";
		$Sortie .= "<option value=\"BBC\"".$SBBC.">Exporter au format BBCode (Forum)";
		$Sortie .= "</select>";
		$Sortie .= "</form>";
		
		$VIP = fonction("bilanVIP");
		if ($Type == "BBC")			{ $Sortie .= fonction("affVIP_bbc", array($VIP)); }
		else if ($Type == "HTML")	{ $Sortie .= fonction("affVIP_html", array($VIP)); }
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page"); }
	
	$Sortie .= "</div>";
	
	return $Sortie;
	}

?>
