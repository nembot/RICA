<?php

function reboot()
	{
	/* Date actuellement affich�e */
	$Debut = file_get_contents("http://www.ngswing.com/export/debut_partie.php");
	if ($Debut !== FALSE)
		{
		$lastCron = fonction("SQL", array("SELECT valeur FROM informations WHERE nom=\"lastCron\"",__LINE__,"VAL",__FILE__));
		if ($Debut > $lastCron)
			{
			$Coru = file_get_contents("http://www.ngswing.com/export/loc_coruscant.php");
			if ($Coru !== FALSE)
				{
				$Hoth = file_get_contents("http://www.ngswing.com/export/loc_hoth.php");
				if ($Hoth !== FALSE)
					{
					/* Informations */
					/* Nettoyage des entr�es */
					fonction("SQL", array("TRUNCATE TABLE informations",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("TRUNCATE TABLE entrees",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("TRUNCATE TABLE statistiques",__LINE__,"EXE",__FILE__));

					fonction("SQL", array("INSERT INTO informations (nom, valeur) VALUES (\"coruscant\", \"".$Coru."\")",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("INSERT INTO informations (nom, valeur) VALUES (\"hoth\", \"".$Hoth."\")",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("INSERT INTO informations (nom, valeur) VALUES (\"reboot\", \"".$Debut."\")",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("INSERT INTO informations (nom, valeur) VALUES (\"lastCron\", \"".$Debut."\")",__LINE__,"EXE",__FILE__));

					echo "reboot() : Reboot effectué\n";
				}
				else { echo "reboot() : Echec de la connexion à SWING (Hoth)\n"; }
				}
			else { echo "reboot() : Echec de la connexion à SWING (Coru)\n"; }
			}
		else { echo "reboot() : Pas de reboot entre temps\n"; }
		}
	else { echo "reboot() : Echec de la connexion à SWING (Debut)\n"; }

	/* Last check */
	fonction("SQL", array("UPDATE informations SET valeur=\"".time()."\" WHERE nom=\"lastCron\"",__LINE__,"EXE",__FILE__));
	}

?>

