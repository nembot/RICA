<?php

function affSuggestions()
	{
	$Sortie = "<div id=\"body\">";
	
	if (isset($_SESSION['pseudo']))
		{
		/* Conversations - Collecte */
		$Conversations = fonction("SQL",
			array(
				"SELECT
					IDc,
					titre,
					etat,
					MAX(date) as last,
					COUNT(IDm) as nbrMessages,
					GROUP_CONCAT(IDm SEPARATOR '-') as messages
				FROM conversations
				RIGHT JOIN messages USING(IDc)
				GROUP BY IDc
				ORDER BY last DESC
				",
				__LINE__,"TAB",__FILE__
				)
			);
		
		/* Sujet ouvert */
		if (isset($_GET['C']) AND preg_match("#^[0-9]+$#", $_GET['C']))	{ $Sujet = $_GET['C']; }
		else													{ $Sujet = FALSE; }
	
		/* Conversations - Mise en forme */
		$Sortie .= "<table class=\"conversations\">";
		$Sortie .= "<tr>";
		$Sortie .= "<th class=\"etat\">Etat</th>";
		$Sortie .= "<th class=\"titre\">Sujet</th>";
		$Sortie .= "<th class=\"messages\">Messages</th>";
		$Sortie .= "<th class=\"dernier\">Dernier message</th>";
		$Sortie .= "</tr>";
		$Sortie .= "</table>";
		
		if ($Sujet === FALSE) { $Sortie .= "<div id=\"conversations\" class=\"ouvert\">"; }
		else                  { $Sortie .= "<div id=\"conversations\" class=\"ferme\">"; }
		
		$Sortie .= "<table class=\"conversations \">";
		
		/* Conversations - Affichage */
		foreach($Conversations as $C)
			{
			$Sortie .= "<tr>";
			$Sortie .= "<td class=\"etat ".$C['etat']."\">".$C['etat']."</td>";
			$Sortie .= "<td class=\"titre\"><a href=\"index.php?P=suggestions&amp;C=".$C['IDc']."\">".$C['titre']."</a></td>";
			
			/* Nombre de messages */
			$nbrNews = fonction("nonLus_sujet", array($C['messages']));
			$Sortie .= "<td class=\"messages\">".$C['nbrMessages'];
			if ($nbrNews > 0)	{ $Sortie .= " <span class=\"new\">(".$nbrNews.")</span>"; }
			$Sortie .= "</td>";
			
			/* Date du plus récent */
			$Stamp = fonction("temps", array("TvS", $C['last']));
			$Sortie .= "<td class=\"dernier\">il y a ".fonction("interval", array($Stamp))."</td>";
			
			$Sortie .= "</tr>";
			}
		$Sortie .= "</table>";
		$Sortie .= "</div>";
		
		$Sortie .= "<div onClick=\"toutlu()\" class=\"toutlu\">Marquer tous les sujets comme lus</div>";
		$Sortie .= "<div onClick=\"derouler('conversations')\" class=\"derouler\">Dérouler / Enrouler la liste des sujets</div>";
				
		if ($Sujet !== FALSE)
			{
			/* Messages - Collecte */
			$Messages = fonction("SQL",
				array(
					"SELECT * FROM messages
					LEFT JOIN classement USING(IDs)
					LEFT JOIN conversations USING(IDc)
					WHERE IDc=\"".$Sujet."\"
					ORDER BY date ASC",
					__LINE__,"TAB",__FILE__
					)
				);
			
			/* Messages lus */
			$News = fonction("nonLus_lecture", array($Messages));
			
			/* Messages - Affichage */
			$Sortie .= "<div class=\"sujet\">".$Messages[0]['titre']."</div>";
			foreach($Messages as $M)
				{
				$Sortie .= "<div class=\"suggestion \">";
				$Sortie .= "<span class=\"";
				if ($M['clan'] != "") { $Sortie .= $M['clan']; }
				else                  { $Sortie .= "Neutre"; }
				if (in_array($M['IDm'], $News))	{ $Sortie .= " nouveau"; }
				$Sortie .= "\">";
				if ($M['pseudo'] != "") { $Sortie .= $M['pseudo']; }
				else                    { $Sortie .= "<i>Joueur ".$M['IDs']."</i>"; }
				$Sortie .= "</span>&nbsp;: ";
				$Sortie .= $M['message'];
				$Sortie .= "</div>";
				}
			}
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page"); }
	
	$Sortie .= "</div>";
	
	return $Sortie;
	}

?>
