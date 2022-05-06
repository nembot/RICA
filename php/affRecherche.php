<?php

function affRecherche( $Index=25 )
	{
	$Sortie = "<div id=\"body\">";
	
	if (isset($_SESSION['pseudo']))
		{
		/* Mots clés */
		if (isset($GLOBALS['mots']))	{ $Mots = $GLOBALS['mots']; }
		else							{ $Mots = array(); }
		
		/* Collecte */
		$Requete = fonction("requete", array($Mots, $Index));
		$Messages = fonction("SQL", array($Requete,__LINE__,"TAB",__FILE__));
		
		/* Grouper par cible */
		if ($GLOBALS['grouper'])
			{ $Messages = fonction("grouperRecherche", array($Messages)); }
		
		/* Mise en page */
		switch($GLOBALS['sortie'])
			{
			case "BBCode":				$Sortie .= fonction("affRecherche_bbc", array($Messages, $Mots)); break;
			case "Rechercher": default:	$Sortie .= fonction("affRecherche_html", array($Messages, $Mots)); break;
			}
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page"); }
	
	$Sortie .= "</div>";
	
	return $Sortie;
	}

?>
