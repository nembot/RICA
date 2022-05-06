<?php

function post()
	{
	/* Recherche - Requête */
	if (isset($_POST['recherche']))	{ $Recherche = stripslashes($_POST['recherche']); }
	elseif (isset($_GET['R']))		{ $Recherche = stripslashes($_GET['R']); }
	else							{ $Recherche = ""; }
	$Recherche = preg_replace("#^\s+#", "", $Recherche);
	$Recherche = preg_replace("#\s+$#", "", $Recherche);
	if (strlen($Recherche) <= 100)
		{
		/* Mots clés */
		$Mots = array();
		if ($Recherche != "")
			{
			foreach(preg_split("# ?\+ ?#", $Recherche) as $M)
				{
				$Mot = fonction("signes", array($M));
				if ($Mot != "") { $Mots[] = $Mot; }
				}
			}
		$GLOBALS['mots'] = $Mots;
		$GLOBALS['recherche'] = $Recherche;
		}
	else
		{
		$GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Les recherches sont limitées à 100 caractères");
		$GLOBALS['mots'] = array();
		$GLOBALS['recherche'] = "";
		}

	/* Recherche - Grouper */
	$GLOBALS['grouper'] = ( isset($_POST['grouper']) OR ( isset($_GET['G']) AND $_GET['G'] == "1" ) );

	/* Recherche - Limites type */
	if (isset($_POST['limite_type']))	{ $Type = stripslashes($_POST['limite_type']); }
	elseif (isset($_GET['T']))			{ $Type = stripslashes($_GET['T']); }
	else								{ $Type = ""; }
	switch($Type)
		{
		case "heures":	$GLOBALS['heures'] = TRUE; $GLOBALS['jours'] = FALSE; break;
		case "jours":	$GLOBALS['jours'] = TRUE; $GLOBALS['heures'] = FALSE; break;
		default:		$GLOBALS['jours'] = FALSE; $GLOBALS['heures'] = FALSE;
		}

	/* Recherche - Limites */
	if (isset($_POST['limite']))	{ $Limite = stripslashes($_POST['limite']); }
	elseif (isset($_GET['L']))		{ $Limite = stripslashes($_GET['L']); }
	else							{ $Limite = ""; }
	if (preg_match("#^[0-9]+$#", $Limite))	{ $GLOBALS['limite'] = $Limite; }
	else									{ $GLOBALS['limite'] = FALSE; }

	/* Recherche - Type */
	if (isset($_POST['rechercher']))	{ $Type = stripslashes($_POST['rechercher']); }
	elseif (isset($_GET['S']))			{ $Type = stripslashes($_GET['S']); }
	else								{ $Type = ""; }
	if (in_array($Type, array("Rechercher", "BBCode")))	{ $GLOBALS['sortie'] = $Type; }
	else												{ $GLOBALS['sortie'] = FALSE; }
	}

?>
