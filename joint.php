<?php

header('Content-type: text/html; charset=ISO-8859-15');

session_start();

$GLOBALS['dialogues'] = array();

/* Initialisation */
require("fonction.php");
require("alerte.php");
set_error_handler("alerte");
$GLOBALS['token'] = base_convert(md5(microtime(TRUE), FALSE), 16, 36);
date_default_timezone_set("Europe/Paris");

/* Connexion auto */
fonction("connexionAuto");

/* Affichages */
$Abstract = "";
$Content = "";
if (isset($_SESSION['pseudo']))
	{
	/* Numéro d'entrée */
	if (isset($_GET['E']))		{ $IDe = $_GET['E']; }
	elseif (isset($_GET['M']))	{ $IDe = $_GET['M']; }
	else						{ $IDe = ""; }

	if (preg_match("#^[0-9]+$#", $IDe))
		{
		$Message = fonction("SQL",
			array("SELECT IDe, clan, elements, date, original, joint FROM entrees WHERE IDe=\"".$IDe."\"",__LINE__,"ARR",__FILE__)
			);
		if ($Message != array())
			{
			if ($_SESSION['clan'] == $Message['clan'])
				{
				/* Header */
				$Elements = preg_split("#§#", $Message['elements']);
				$Abstract .= "<div id=\"abstract\">";
				$Abstract .= "<div class=\"titre\" onClick=\"derouler('Mess".$Message['IDe']."')\">".$Elements[0]."</div>";
				$Abstract .= "<dl id=\"Mess".$Message['IDe']."\" class=\"ferme\">";
				$Abstract .= "<dt>Ajouté le ".fonction("temps", array("TvD", $Message['date'], "#Jc #N2 #Mc #A4 à #H2:#I2:#S2"))."</dt>";
				for( $N = 1 ; $N < count($Elements) ; $N ++ )
					{ $Abstract .= "<dd>".$Elements[$N]."</dd>"; }
				$Abstract .= "</dl>";
				$Abstract .= "</div>";
			
				/* Body */
				$Content .= "<div id=\"content\">";
				if (isset($_GET['original']) AND $_SESSION['pseudo'] == "NeM")
					{ $Content .= "<pre>".gzuncompress($Message['original'])."</pre>"; }
				else { $Content .= gzuncompress($Message['joint']); }
				$Content .= "</div>";
				}
			else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Vous n'avez pas accès à cette entrée"); }
			}
		else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Cette entrée n'existe pas"); }
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Identifiant d'entrée incorrect"); }
	}
else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page"); }

/* Dialogues */
$Dialogue = "";
foreach($GLOBALS['dialogues'] as $D)
	{ $Dialogue .= "<div class=\"dialogue ".$D['type']."\">".$D['message']."</div>"; }

/* HTML */
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head>
		<title>Réseau RICA</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html;charset=ISO-8859-15\">
		<link rel=\"shortcut icon\" type=\"image/gif\" href=\"images/icone.gif\">
		<link rel=\"StyleSheet\" href=\"imports/styles.css?MaJ=".filemtime("imports/styles.css")."\" type=\"text/css\">
		<script type=\"text/javascript\" src=\"imports/scripts.js?MaJ=".filemtime("imports/scripts.js")."\"></script>
		<script type=\"text/javascript\" src=\"imports/jquery_144.js\"></script>
		<script type=\"text/javascript\" src=\"imports/jquery_tablesorter.js\"></script>
	</head>
	<body class=\"".fonction("fond")."\">

		".$Abstract."

		".$Dialogue."

		".$Content."

		<div id=\"pied\">Réalisé par Ziliev et repris par Nem et Mythik pour <a href=\"http://www.ngswing.com\" target=\"_blank\">Star Wars in New Generation</a>, sous licence <a href=\"http://creativecommons.org/licenses/by-nc/2.0/fr/\" target=\"_blank\">Creative Commons</a></div>
		
	</body>
</html>";

session_write_close();

?>
