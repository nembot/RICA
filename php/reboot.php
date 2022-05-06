<?php

function reboot()
	{
	/* Date actuellement affichée */
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
					fonction("SQL", array("UPDATE informations SET valeur=\"".$Coru."\" WHERE nom=\"coruscant\"",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("UPDATE informations SET valeur=\"".$Hoth."\" WHERE nom=\"hoth\"",__LINE__,"EXE",__FILE__));
					fonction("SQL", array("UPDATE informations SET valeur=\"".$Debut."\" WHERE nom=\"reboot\"",__LINE__,"EXE",__FILE__));
					
					/* Dump des entrées */
					$fileName = "dumps/".date("Y-m-d")." - entrees.sql";
					$file = fopen($fileName, "w+");
					$dump = fonction("SQL", array("SELECT IDe, IDs, clan, date, HEX(original) AS original, HEX(elements) AS elements, HEX(joint) AS joint FROM entrees",__LINE__,"BRT",__FILE__));
					$status = $file !== FALSE;
					while ($status AND $row = mysqli_fetch_assoc($dump))
						{
						$ligne = "INSERT INTO entrees VALUES(";
						$ligne .= "\"".$row['IDe']."\", ";
						$ligne .= "\"".$row['IDs']."\", ";
						$ligne .= "\"".$row['clan']."\", ";
						$ligne .= "\"".$row['date']."\", ";
						$ligne .= "UNHEX(\"".$row['original']."\"), ";
						$ligne .= "UNHEX(\"".$row['elements']."\"), ";
						$ligne .= "UNHEX(\"".$row['joint']."\")";
						$ligne .= ");\n";
						$status = fwrite($file, $ligne) !== FALSE;
						}
					$status = $status AND fclose($file);
					
					if ($status AND file_exists($fileName))
						{
						/* Dump des statistiques */
						$fileName = "dumps/".date("Y-m-d")." - statistiques.sql";
						$file = fopen($fileName, "w+");
						$dump = fonction("SQL", array("SELECT * FROM statistiques",__LINE__,"BRT",__FILE__));
						$status = $file !== FALSE;
						while ($status AND $row = mysqli_fetch_row($dump))
							{
							$ligne = "INSERT INTO entrees VALUES(\"";
							$ligne .= implode("\", \"", $row);
							$ligne .= "\");\n";
							$status = fwrite($file, $ligne) !== FALSE;
							}
						$status = $status AND fclose($file);
						
						/* Finalisation */
						if ($status AND file_exists($fileName))
							{
							/* Nettoyage des entrées */
							fonction("SQL", array("TRUNCATE TABLE entrees",__LINE__,"EXE",__FILE__));
							fonction("SQL", array("TRUNCATE TABLE statistiques",__LINE__,"EXE",__FILE__));
							echo "reboot() : Reboot effectué\n";
							}
						else { echo "reboot() : Erreur d'écriture (statistiques)\n"; }
						}
					else { echo "reboot() : Erreur d'écriture (entrees)\n"; }
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
