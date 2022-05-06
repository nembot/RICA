<?php

function carte_format($Array)
	{
	/* Tri des objets */
	$Objets = $Array['objets'];
	$Criteres = array("clan", "puissance");
	$Sens = array("ASC", "DESC");
	$Types = array("STRING", "NUMERIC");
	$Objets = fonction("triSQL", array($Objets, $Criteres, $Sens, $Types));
	
	/* Initialisation des tableau */
	$Legende = "";
	$Image = "";

	/* Chaque objet */
	foreach($Objets as $O)
		{
		/* Images */
		if(preg_match("#^data:image#", $O['img'])) { $Image .= "\n\t\t\t\t<img src=\"".$O['img']."\" alt=\"\" style=\"";
		} else                                     { $Image .= "\n\t\t\t\t<img src=\"http://www.ngswing.com/skin/Normal/global/FightView/".$O['img']."\" alt=\"\" style=\"";
		}
		$Image .= "top: ".round(($O['Y']-$Array['Ymin']+1)*38)."px;";
		$Image .= " left: ".round(($O['X']-$Array['Xmin']+1)*38)."px;";
		if ($O['clan'] == "") { $Image .= "\" class=\"Neutre\""; }
		else                  { $Image .= "\" class=\"".$O['clan']."\""; }
		$Image .= " id=\"Img".$O['numero']."\"";
		$Image .= " onMouseOver=\"survol_on('".$O['numero']."')\"";
		$Image .= " onMouseOut=\"survol_off('".$O['numero']."')\"";
		$Image .= " onClick=\"selection('".$O['numero']."')\">";
		
		
		/* Légende */
		$Legende .= "\n\t\t\t\t\t<tr id=\"Leg".$O['numero']."\">";
		
		/* Légende - Ceinture */
		if (preg_match("#~([0-9]+)$#", fonction("secteur", array($O['X'], $O['Y'], TRUE, 5)), $Matches))
		     { $Legende .= "<td class=\"ceinture\" onClick=\"selection('".$O['numero']."')\" title=\"Surligner\">".$Matches[1]."</td>"; }
		else { $Legende .= "<td class=\"ceinture\" onClick=\"selection('".$O['numero']."')\" title=\"Surligner\">6+</td>"; }
		
		/* Légende - Coordonnées */
		$Legende .= "<td class=\"click\">".$O['X']."</td>";
		$Legende .= "<td class=\"click\">".$O['Y']."</td>";
		
		/* Légende - Joueur */
		if ($O['clan'] == "Neutre") { $Legende .= "<td><i>Neutre</i></td>"; }
		else
			{
			$Lien = "http://www.ngswing.com/infoperso.php?id1=".$O['id1']."&".$O['idX'];
			$Legende .= "<td><a href=\"".$Lien."\" target=\"_blank\" title=\"Fiche\" class=\"".$O['clan']."\">";
			$Legende .= $O['joueur']."</a></td>";
			}
		
		/* Légende - Clan */
		$Legende .= "<td class=\"".$O['clan']."\">".substr($O['clan'],0,1)."</td>";
		
		/* Légende - Type */
		switch($O['type'])
			{
			case "Flotte":				$Legende .= "<td class=\"type\">F</td>"; break;
			case "Planète":				$Legende .= "<td class=\"type\">P</td>"; break;
			case "Centre d'influence":	$Legende .= "<td class=\"type\">Centre</td>"; break;
			default:					$Legende .= "<td class=\"type\">?</td>"; break;
			}
		
		/* Légende - Nom */
		$Arg = urlencode($O['type']." : ".$O['nom']);
		$Legende .= "<td><a href=\"index.php?R=".$Arg."\" target=\"_blank\" title=\"Rechercher\">";
		$Legende .= $O['nom']." (".$O['numero'].")</a></td>";
		
		/* Légende - Puissance : attention au bonux Week end "###" ! */
		if (preg_match("#^[0-9]+$#", $O['puissance']))	{ $Puissance = number_format($O['puissance'], 0, ",", "."); }
		else											{ $Puissance = $O['puissance']; }
		$Legende .= "<td class=\"puissance\">".$Puissance."</td>";
		
		$Legende .= "</tr>";
		}
	
	/* Page - Tete */
	$Affichage  = "<div id=\"carte\" style=\"";
	$Affichage .= "left:".((707-($Array['Xmax']-$Array['Xmin']+2)*38)/2)."px;";
	$Affichage .= "width:".(($Array['Xmax']-$Array['Xmin']+2)*38)."px;";
	$Affichage .= "height:".(($Array['Ymax']-$Array['Ymin']+2)*38)."px;";
	$Affichage .= "\">";
	
	/* Angle superieur gauche */
	$Affichage .= "\n\t\t\t\t<div style=\"";
	$Affichage .= "top: 0px;";
	$Affichage .= " left: 0px;";
	$Affichage .= "\">X/-Y</div>";
		
	/* Coordonnées X */
	$Y = $Array['Ymin'];
	$X = $Array['Xmin'];
	while($X <= $Array['Xmax'])
		{
		$Affichage .= "\n\t\t\t\t<div style=\"";
		$Affichage .= "top: ".round(($Y-$Array['Ymin'])*38)."px;";
		$Affichage .= " left: ".round(($X-$Array['Xmin']+1)*38)."px;";
		$Affichage .= "\">".$X."</div>";
		$X++;
		}
	
	/* Coordonnées Y */
	$Y = $Array['Ymin'];
	$X = $Array['Xmin'];
	while($Y <= $Array['Ymax'])
		{
		$Affichage .= "\n\t\t\t\t<div style=\"";
		$Affichage .= "top: ".round(($Y-$Array['Ymin']+1)*38)."px;";
		$Affichage .= " left: ".round(($X-$Array['Xmin'])*38)."px;";
		$Affichage .= "\">-".$Y."</div>";
		$Y++;
		}
	
	/* Fin de l'image */
	$Affichage .= $Image."

				<table id=\"legende_info\"><tr><th>~</th><th>X</th><th>Y</th><th>Joueur</th><th>Clan</th><th>Type</th><th>Nom</th><th>Puissance</th></tr></table>
				<table id=\"table_info\"><tr id=\"tr_info\"></tr></table>
			</div>
			
			<table id=\"legende\" class=\"tablesorter\">
				<thead><tr><th>~</th><th>X</th><th>Y</th><th>Joueur</th><th>Clan</th><th>Type</th><th>Nom</th><th>Puissance</th></tr></thead>
				<tbody>".$Legende."
				</tbody>
			</table>
			
			Cliquer sur un titre de colonne, ou plusieurs en maintenant Shift, pour trier ce tableau";
	
	return $Affichage;
	}

?>
