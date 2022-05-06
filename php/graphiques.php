<?php

function graphiques()
	{
	/* Initialisations */
	$X = array();
	$Y = array();
	$Couleurs = array(
		"contrebande" => "#228822",
		"empire" => "#115588",
		"rebellion" => "#AA2222",
		"neutre" => "#000000",
		"fond" => "#111111",
		"axes" => "#555555",
		"jours" => "#222222",
		"titre" => "#BE8C14"
		);

	/* Conversion en vecteurs */
	$Stats = fonction("SQL", array("SELECT * FROM statistiques ORDER BY date ASC",__LINE__,"TAB",__FILE__));
	$Clans = array("contrebande", "empire", "neutre", "rebellion");
	foreach($Stats as $Ligne)
		{
		foreach($Clans as $C)
			{
			$Y[ $Ligne['categorie'] ][ $C ][] = $Ligne[ $C ];
			$X[ $Ligne['categorie'] ][ $C ][] = fonction("temps", array("TvS", $Ligne['date']));
			}
		}
	
	/* Limites fixes */
	$Xmin = min( fonction("array_flatten", array($X)) );
	$Xmax = max( fonction("array_flatten", array($X)) );
	$Ymin = 0;
	
	/* Limites variables */
	$Ymax['Flottes Hoth'] = $Ymax['Flottes Coruscant'] = max(
		array_merge(
			fonction("array_flatten", array($Y['Flottes Hoth'])),
			fonction("array_flatten", array($Y['Flottes Coruscant']))
			)
		);
	
	/* Différentes images */
	foreach($X as $Categorie => $X_Cat)
		{
		$Fichier = "statistiques/".$Categorie.".png";
		
		/* Création de l'objet image */
		$Array = fonction("gd_creer", array(700, 100, $Couleurs, TRUE));
	
		/* Paramètres */
		$Array['marges'] = array("X1"=>25, "X2"=>5, "Y1"=>8, "Y2"=>8);
		$Array['inners'] = array("X"=>3, "Y"=>0);
		$Array['limites']['Xmin'] = $Xmin;
		$Array['limites']['Ymin'] = $Ymin;
		$Array['limites']['Xmax'] = $Xmax;
		if (isset($Ymax[ $Categorie ]))	{ $Array['limites']['Ymax'] = $Ymax[ $Categorie ]; }
		else							{ $Array['limites']['Ymax'] = max( fonction("array_flatten", array($Y[ $Categorie ])) ); }
		
		/* Axes */
		$Array = fonction("gd_axes", array($Array, FALSE, TRUE));
				
		/* Jours */
		$Origine = $Array['limites']['Xmin'];
		$Origine = mktime(0,0,0, date("n", $Origine), date("j", $Origine)+1, date("Y", $Origine));
		while($Origine < $Array['limites']['Xmax'])
			{
			$Xcrd = fonction("gd_coord", array($Array, $Origine, "X"));
			
			/* Lignes verticales */
			imageline($Array['image'],
				$Xcrd, 8,
				$Xcrd, 92,
				$Array['couleurs']['jours']
				);
			
			/* Jour \n Mois */
			imagestring($Array['image'],
				1,
				$Xcrd+2, 42,
				date("d", $Origine),
				$Array['couleurs']['jours']
				);
			imagestring($Array['image'],
				1,
				$Xcrd+2, 50,
				date("m", $Origine),
				$Array['couleurs']['jours']
				);
			
			$Origine += 60*60*24;
			}
				
		/* Lignes */
		foreach($X_Cat as $Clan => $X_Cat_Clan)
			{ $Array = fonction("gd_lignes", array($Array, $X[$Categorie][$Clan], $Y[$Categorie][$Clan], $Clan)); }
		
		/* Titre */
		imagestring($Array['image'],
			2,
			32, 5,
			$Categorie,
			$Array['couleurs']['titre']
			);
		
		/* RICA */
		imagestring($Array['image'],
			1,
			32, 20,
			"rica.ovsa.fr",
			$Array['couleurs']['axes']
			);
	
		/* Sauvegarde du fichier */
		imagepng($Array['image'], $Fichier);
	
		/* Affichage */
		echo "graphiques() : ".$Categorie." terminé\n";
		}
	}

?>
