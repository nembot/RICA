<?php

function majClassement()
	{
	/* En-tête de la requête */
	$Requete = "INSERT INTO classement (rang, clan, IDs, pseudo, guilde, niveau, parsecs, planetes, puissance) VALUES\n";
	$Securite = 0;
	$Stop = FALSE;
	
	$URL = array(
		"http://www.ngswing.com/export/classement_cb.php",
		"http://www.ngswing.com/export/classement.php"
		);
	
	foreach($URL as $U)
		{
		/* Import du classement */
		$HTML = file_get_contents($U);
		if ($HTML === FALSE) { $Stop = TRUE; }
		
		// DEBUG
		file_put_contents("logs/majClassement_".date("Y-m-d_H:i:s").".txt", $HTML);

		/* Joueur par joueur */
		$Classement = preg_split("#\n\r<br>#", $HTML);
		unset($Classement[ count($Classement)-1 ]);
		foreach($Classement as $Joueur)
			{
			$J = fonction("signes", array($Joueur));
			$J = preg_split("#\t#", $J);
			
			/* Clan */
			switch($J[1])
				{
				case "1": $J[1] = "Empire"; break;
				case "2": $J[1] = "Rebellion"; break;
				case "3": $J[1] = "Contrebande"; break;
				}
			
			$Requete .= "\t(";
			$Requete .= "\"".implode($J, "\", \"")."\"";
			$Requete .= "),\n";
			
			$Securite++;
			}
		}
	
	$Requete = substr($Requete, 0, -2);
	
	// Rustine si Kin refait le coup des joueurs en double
	$Requete .= " ON DUPLICATE KEY UPDATE puissance=puissance";
	
	echo $Requete;

	if ($Securite > 10 AND !$Stop)
		{
		/* Execution */
		fonction("SQL", array("TRUNCATE TABLE classement",__LINE__,"EXE",__FILE__));
		echo "a";
		fonction("SQL", array($Requete,__LINE__,"EXE",__FILE__));	
		echo "b";
		
		/* Conclusion */
		echo "majClassement() : Mise à jour réussie\n";
		}
	else
		{ echo "majClassement() : Echec de la mise à jour\n"; }
	}

?>
