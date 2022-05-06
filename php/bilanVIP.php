<?php

function bilanVIP()
	{
	$VIP = fonction("vip");
	
	/* Collecte des éléments */
	$Requete = "SELECT
				IDe, date, elements,
				entrees.clan as PClan,
				classement.pseudo as PPseudo
			FROM entrees
			LEFT JOIN classement USING(IDs)
			WHERE
				entrees.clan = \"".$_SESSION['clan']."\"
				AND elements LIKE \"%§Type : Rapport%\"
				AND elements LIKE \"%§VIP%\"
			ORDER BY date ASC";
	$SQL = fonction("SQL", array($Requete,__LINE__,"BRT",__FILE__));
	
	/* Création du bilan */
	while ($Tmp = mysqli_fetch_assoc($SQL))
		{
		/* Info VIP */
		preg_match_all("#(?<=§)VIP (allié|ennemi) : (.+?) [\<\(]#", $Tmp['elements']."§", $Matches);
		$N=0; while(isset($Matches[0][$N]))
			{
			$Qui = $Matches[1][$N];
			$Nom = $Matches[2][$N];
		
			/* Autres éléments */
			$Array = array();
			$Elements = preg_split("#§#", $Tmp['elements']);
			foreach($Elements as $E)
				{
				preg_match("#^(?:([^:]+) : )?(.*)$#", $E, $SousElement);
				if ($SousElement[1] == "") { $SousElement[1] = "fiche"; }
				$Array[ $SousElement[1] ] = $SousElement[2];
				}
			
			/* Fiche du joueur */
			preg_match("#href='(.*?)'#", $Array['fiche'], $Fiche);
			$VIP[ $Nom ]['Fiche'] = $Fiche[1];
			
			/* Ajout au bilan */
			if ($Qui == "allié")
				{
				$VIP[ $Nom ]['Joueur'] = $Tmp['PPseudo'];
				$VIP[ $Nom ]['JClan'] = $Tmp['PClan'];
				
				$VIP[ $Nom ]['Objet'] = "Allié";
				$VIP[ $Nom ]['Type'] = "Inconnu";
				}
			else if ($Qui == "ennemi")	
				{
				$VIP[ $Nom ]['Joueur'] = $Array['Joueur'];
				$VIP[ $Nom ]['JClan'] = $Array['Clan'];
				
				if (isset($Array['Flotte']))
					{
					$VIP[ $Nom ]['Objet'] = $Array['Flotte'];
					$VIP[ $Nom ]['Type'] = "Flotte";
					}
				else if (isset($Array['Planète']))
					{
					$VIP[ $Nom ]['Objet'] = $Array['Planète'];
					$VIP[ $Nom ]['Type'] = "Planète";
					}
				else if (isset($Array['Centre d\'influence']))
					{
					$VIP[ $Nom ]['Objet'] = $Array['Centre d\'influence'];
					$VIP[ $Nom ]['Type'] = "Centre d'influence";
					}
				else if ($Array['Type'] == "Rapport de défense")
					{
					$VIP[ $Nom ]['Objet'] = "Flotte ennemie";
					$VIP[ $Nom ]['Type'] = "Flotte";
					}
				}
		
			$VIP[ $Nom ]['IDe'] = $Tmp['IDe'];
			$VIP[ $Nom ]['Date'] = $Tmp['date'];
			$VIP[ $Nom ]['Position'] = $Array['Position'];
			$VIP[ $Nom ]['Secteur'] = $Array['Secteur'];
			
			$N++;
			}
		}
	
	/* Bug du au changement de norme */
	unset($VIP['*']);
	
	return $VIP;
	}

?>
