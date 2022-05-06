<?php

function statistiques($MAJ)
	{
	/* Requêtes d'interrogation */
	$Requetes = array(
	
		"SWING Inscrits" => "
			SELECT
				clan,
				COUNT(IDs) AS valeur
			FROM classement
			GROUP BY clan",
		
		"SWING Actifs" => "
			SELECT
				clan,
				COUNT(IDs) AS valeur
			FROM classement
			WHERE parsecs > 5000 OR niveau > 0
			GROUP BY clan",
		
		"RICA Inscrits" => "
			SELECT
				classement.clan,
				COUNT(IDs) AS valeur
			FROM inscrits
			LEFT JOIN classement USING(IDs)
			GROUP BY classement.clan",
		
		"RICA Actifs" => "
			SELECT
				classement.clan,
				COUNT(DISTINCT IDs) AS valeur
			FROM entrees
			LEFT JOIN classement USING(IDs)
			WHERE DATEDIFF(NOW(), entrees.date) < 8
			GROUP BY classement.clan",
		
		"Entrees" => "
			SELECT
				entrees.clan,
				COUNT(IDe) AS valeur
			FROM entrees
			GROUP BY entrees.clan"

		);
	
	/* Rassemblement des résultats */
	$Lignes = 0;
	$Requete = "INSERT INTO statistiques (date, categorie, contrebande, empire, neutre, rebellion) VALUES\n";
	
	foreach($Requetes as $I => $R)
		{
		/* Interrogation */
		$Table = fonction("SQL", array($R,__LINE__,"TAB",__FILE__));
		
		/* Fetch par clan */
		$Comptes = array("Contrebande"=>0, "Empire"=>0, ""=>0, "Rebellion"=>0);
		foreach($Table as $Ligne) { $Comptes[ $Ligne['clan'] ] = $Ligne['valeur']; }
		
		/* Ajout aux requêtes de MaJ */
		$Requete .= "\t(\"".$MAJ."\", \"".$I."\"";
		$Requete .= ", \"".$Comptes['Contrebande']."\"";
		$Requete .= ", \"".$Comptes['Empire']."\"";
		$Requete .= ", \"".$Comptes['']."\"";
		$Requete .= ", \"".$Comptes['Rebellion']."\"";
		$Requete .= "),\n";
		$Lignes++;
		}
	
	$Requete = substr($Requete, 0, -2);
	
	/* Execution */
	$Reussites = fonction("SQL", array($Requete,__LINE__,"EXE",__FILE__));
	if ($Reussites == $Lignes)	{ echo "statistiques() : Mise à jour réussie\n"; }
	else						{ echo "statistiques() : Echec de la Mise à jour\n"; }
	}

?>
