<?php

function statsCarte($MAJ, $Largeur=5)
	{
	$Image = imagecreatefrompng("http://www.ngswing.com/Carte/galaxie.png");
	if ($Image !== FALSE)
		{
		/* Initialisation */
		$Requete = "INSERT INTO statistiques (date, categorie, contrebande, empire, neutre, rebellion) VALUES\n";
		$Hoth = fonction("SQL", array("SELECT valeur FROM informations WHERE nom='hoth'", __LINE__,"VAL",__FILE__));
		$Coru = fonction("SQL", array("SELECT valeur FROM informations WHERE nom='coruscant'", __LINE__,"VAL",__FILE__));
		
		/* Hoth */
		preg_match('#^([0-9]+)/([0-9]+)$#', $Hoth, $M);
		$Compte = fonction("compteCarte", array($Image, $M[1]-$Largeur, $M[2]-$Largeur, $M[1]+$Largeur, $M[2]+$Largeur));
		$Requete .= "\t(\"".$MAJ."\", \"Flottes Hoth\"";
		$Requete .= ", ".$Compte['flottes']['contrebande'];
		$Requete .= ", ".$Compte['flottes']['empire'];
		$Requete .= ", 0";
		$Requete .= ", ".$Compte['flottes']['rebellion'];
		$Requete .= "),\n";
		
		/* Coruscant */
		preg_match('#^([0-9]+)/([0-9]+)$#', $Coru, $M);
		$Compte = fonction("compteCarte", array($Image, $M[1]-$Largeur, $M[2]-$Largeur, $M[1]+$Largeur, $M[2]+$Largeur));
		$Requete .= "\t(\"".$MAJ."\", \"Flottes Coruscant\"";
		$Requete .= ", ".$Compte['flottes']['contrebande'];
		$Requete .= ", ".$Compte['flottes']['empire'];
		$Requete .= ", 0";
		$Requete .= ", ".$Compte['flottes']['rebellion'];
		$Requete .= "),\n";
		
		/* Execution */
		$Requete = substr($Requete, 0, -2);
		$Reussites = fonction("SQL", array($Requete,__LINE__,"EXE",__FILE__));
		if ($Reussites == 2) { echo "statsCarte() : Mise à jour réussie\n"; }
		else                 { echo "statsCarte() : Echec de la Mise à jour\n"; }
		}
	else { echo "statsCartes() : Echec de la récupération\n"; }
	}

?>
