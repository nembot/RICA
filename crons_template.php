<?php

/* Initialisation */
require("fonction.php");
require("alerte.php");
set_error_handler("alerte");
$GLOBALS['token'] = base_convert(md5(microtime(TRUE), FALSE), 16, 36);
date_default_timezone_set("Europe/Paris");

/* Date commune de MaJ */
$MAJ = date("Y-m-d H-i-s");

/* Scripts à executer */
echo "\n".$MAJ."\n";
fonction("reboot");
fonction("majClassement");
fonction("joueurs");
fonction("statistiques", array($MAJ));
fonction("statsCarte", array($MAJ));
fonction("graphiques");
fonction("exportStats");
echo "OK\n\n";

?>
