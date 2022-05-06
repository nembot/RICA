<?php

function carte_parse($Array, $Texte)
	{
	$Lignes = preg_split("#<tr class=\"row\">#", $Texte);
	$L=2; while(isset($Lignes[$L]))
		{
		$Colonnes = preg_split("#<td( style=\"width:35px; height:35px\")?>#", $Lignes[$L]);
		$C=1; while(isset($Colonnes[$C]))
			{
			$Xc = $Array['Xmin'] + $C - 2;
			$Yc = $Array['Ymin'] + $L - 2;
			preg_match("#<img src=\"(.*?)\" class=\"Border([0-9]|Nothing)\"#", $Colonnes[$C], $Img);
			$vide = array(
			  "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjAQMAAAAkFyEaAAAAA1BMVEUAAACnej3aAAAADElEQVQI12NgGG4AAADSAAGBup/wAAAAAElFTkSuQmCC",
			  "skin/Normal/global/FightView/nothing.gif"
			);
			if (isset($Img[1]) AND $Img[1] != $vide[0] AND $Img[1] != $vide[1])
				{
				preg_match("#<td width=\"100%\" colspan=\"2\">(<b>)?(.*?) \(([PF][0-9]+)\)(</b>)?</td>#", $Colonnes[$C], $Nom);
				preg_match("#<td align=\"left\">Joueur:</td><td align=\"left\">(.*?)</td>#", $Colonnes[$C], $Joueur);
				preg_match("#<td align=\"left\">Puissance:</td><td align=\"left\">(.+?)</td>#", $Colonnes[$C], $Puissance);
				preg_match("#infoperso\.php\?id1=([0-9]+)\&id2=[0-9]+\&(id[^\"]+)\"#", $Colonnes[$C], $Lien);
				
				switch($Img[2])
					{
					case 1: $Clan = "Empire"; break;
					case 2: $Clan = "Rebellion"; break;
					case 3: $Clan = "Contrebande"; break;
					default: $Clan = "Neutre";
					}
				
				if (substr($Nom[3],0,1) == "F")		{ $Type = "Flotte"; }
				else if (substr($Nom[3],0,1) == "P")
					{
					if (substr($Nom[3],1) < 100)	{ $Type = "Centre d'influence"; }
					else				{ $Type = "Planète"; }
					}
				
				$Objet = array(
					"X" => $Xc,
					"Y" => $Yc,
					"img" => preg_replace("#skin/Normal/global/FightView/#", "", $Img[1]),
					"nom" => $Nom[2],
					"numero" => $Nom[3],
					"type" => $Type,
					"joueur" => $Joueur[1],
					"clan" => $Clan,
					"puissance" => preg_replace("#,#", "", $Puissance[1])
					);
				
				/* Info joueur si non neutre */
				if ($Img[2] != "Nothing")
					{
					$Objet["id1"] = $Lien[1];
					$Objet["idX"] = $Lien[2];
					}
				
				$Array['objets'][] = $Objet;
				}
			$C++;
			}
		$L++;		
		}

	$Array['Xmax'] = $Xc;
	$Array['Ymax'] = $Yc;
	$Array['Xmoy'] = round( ($Array['Xmin']+$Array['Xmax']) / 2 );
	$Array['Ymoy'] = round( ($Array['Ymin']+$Array['Ymax']) / 2 );
	$Array['secteur'] = fonction("secteur", array($Array['Xmoy'], $Array['Ymoy']));
	
	return $Array;
	}

?>
