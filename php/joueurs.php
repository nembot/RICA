<?php

function joueurs()
	{
	$Joueurs  = "<?php header(\"Expires: ".preg_replace('# \\+[0-9]+$#', "", date("r", (time()+60*60*8+60)))."\") ?>";
	$Joueurs .= "\nfunction joueurs(){";
	$Joueurs .= "\nreturn new Array(";
	
	$Liste = fonction("SQL", array("SELECT pseudo, clan, IDs FROM classement ORDER BY pseudo",__LINE__,"TAB",__FILE__));

	foreach($Liste as $J)
		{
		$Joueurs .= "\nnew Array(";
		$Joueurs .= "\"".$J['pseudo']."\",";
		$Joueurs .= $J['IDs'].",";
		switch($J['clan'])
			{
			case "Contrebande": $Joueurs .= "1"; break;
			case "Empire":      $Joueurs .= "2"; break;
			case "Rebellion":   $Joueurs .= "3"; break;
			default:            $Joueurs .= "0"; break;
			}
		$Joueurs .= "),";
		}
	$Joueurs = substr($Joueurs, 0, -1);
	$Joueurs .= "\n);\n}";
	
	file_put_contents("imports/joueurs.js.php", $Joueurs);
	
	echo "joueurs() : Mise à jour réussie\n";
	}

?>
