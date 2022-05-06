<?php

function affDetails()
	{
	$Sortie = "<div id=\"body\">";
	
	if (isset($_SESSION['pseudo']))
		{
		$IDm = $_GET['M'];
		if (preg_match("#^[0-9]+$#", $IDm))
			{
			$Message = fonction("SQL", array("SELECT * FROM messages WHERE IDm=\"".$IDm."\"",__LINE__,"ARR",__FILE__));
			if ($Message != array())
				{
				/* En-tête */
				$Elements = preg_split("#§#", $Message['elements']);
				$Sortie .= "<div>".$Elements[0]."</div>";
				$Sortie .= "<dl class=\"ouvert\">";
				$Sortie .= "<dd>Ajouté le ".fonction("temps", array("TvD", $Message['date'], "#Jc #N2 #Mc #A4 à #H2:#I2:#S2"))."</dd>";
				for( $N = 1 ; $N < count($Elements) ; $N += 2 )
					{ $Sortie .= "<dd>".$Elements[$N]." : ".$Elements[$N+1]."</dd>"; }
				$Sortie .= "</dl>";
				
				/* HTML joint */
				$Sortie .= "<br><hr>";
				$Sortie .= gzuncompress($Message['joint']);
				}
			else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Cette information détaillée n'existe pas"); }
			}
		else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Identifiant de message incorrect"); }
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page"); }
	
	$Sortie .= "</div>";
	
	return $Sortie;
	}

?>
