<?php

header('Content-type: text/html; charset=UTF-8');

session_start();

$GLOBALS['dialogues'] = array();

// Maintenance
// $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Connectez vous pour consulter cette page");

/* Initialisation */
require("fonction.php");
require("alerte.php");
set_error_handler("alerte");
$GLOBALS['token'] = base_convert(md5(microtime(TRUE), FALSE), 16, 36);
date_default_timezone_set("Europe/Paris");
fonction("nonLus_get");

/* Deconnexion */
if (isset($_GET['Deconnexion']))
	{
	session_destroy();
	header("Location: index.php");
	setcookie("connexionAuto", "", 0);
	exit();
	}

/* Formulaires */
fonction("connexionManuelle");
fonction("connexionAuto");
fonction("inscription");
fonction("post");
fonction("envoyer");
fonction("discuter");

/* Affichages */
$Header = fonction("affHeader");
$Body = fonction("affBody");

/* Dialogues */
$Dialogue = "";
foreach($GLOBALS['dialogues'] as $D)
	{ $Dialogue .= "<div class=\"dialogue ".$D['type']."\">".$D['message']."</div>"; }

/* HTML */
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head>
		<title>Réseau RICA</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">
		<link rel=\"shortcut icon\" type=\"image/gif\" href=\"images/icone.gif\">
		<link rel=\"StyleSheet\" href=\"imports/styles.css?MaJ=".filemtime("imports/styles.css")."\" type=\"text/css\">
		<script type=\"text/javascript\" src=\"imports/joueurs.js.php\"></script>
		<script type=\"text/javascript\" src=\"imports/scripts.js?MaJ=".filemtime("imports/scripts.js")."\"></script>
	</head>
	<body class=\"".fonction("fond")."\">

		".$Header."

		".$Dialogue."

		".$Body."

		<div id=\"pied\">Réalisé par Ziliev et repris par Nem et Mythik pour <a href=\"http://www.ngswing.com\" target=\"_blank\">Star Wars in New Generation</a>, output sous licence <a href=\"http://creativecommons.org/licenses/by-nc/2.0/fr/\" target=\"_blank\">Creative Commons</a></div>

	</body>
</html>";

session_write_close();

?>
