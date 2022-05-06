<?php

function affRecherche_html($Messages, $Mots)
	{
	$Sortie = "";
	foreach($Messages as $M)
		{
		$Sortie .= "\n\t\t\t<div class=\"reponse\">";

		/* Méta données */
		$Stamp = fonction("temps", array("TvS", $M['date']));
		if ($_SESSION['connecte'] < $Stamp)	{ $Sortie .= "<div class=\"auteur new\">"; }
		else								{ $Sortie .= "<div class=\"auteur\">"; }
		$Sortie .= "<span class=\"".$M['clan']."\">".$M['pseudo']."</span>";
		$Sortie .= ", il y a ".fonction("interval", array($Stamp));
		$Sortie .= "</div>";

		/* Contenu */
		$Sortie .= "<div class=\"message\">";
		$Elements = preg_split("#§#", $M['elements']);

		/* Surligner */
		$Surlignes = array();
		if (count($Elements) == 1) { $E = 0; } else { $E = 1; }
		while(isset($Elements[$E])) 
			{
			$Total = 0;
			foreach($Mots as $Mot)
				{
				$Elements[$E] = preg_replace(
					"#(".fonction("regex", array($Mot, "#")).")#i",
					"<span class='surligne'>$1</span>",
					$Elements[$E], -1, $Counts
					);
				$Total += $Counts;
				}
			$Surlignes[$E] = ($Total > 0);
			$E++;
			} 
		
		/* Pièce jointe */
		if ($M['isJoint'])
			{
			$Sortie .= "<a href='joint.php?E=".$M['IDe']."' class='joint' target='_blank' title='Afficher la pièce jointe'>";
			$Sortie .= "</a>";
			}
		else { $Sortie .= "<div class='noJoint' title='Pas de pièce jointe'></div>"; }
		
		if (count($Elements) > 1)
			{
			/* Titre */
			$Sortie .= "<div class=\"titre\" onClick=\"derouler('Mess".$M['IDe']."')\">".$Elements[0]."</div>";
			$Sortie .= "<dl id=\"Mess".$M['IDe']."\" class=\"ferme\">";
	
			/* Date */
			$Sortie .= "<dd>Ajouté le ".fonction("temps", array("TvD", $M['date'], "#Jc #N2 #Mc #A4 à #H2:#I2:#S2"))."</dd>";
	
			/* Elements */
			for( $N = 1 ; $N < count($Elements) ; $N ++ )
				{
				if ($Surlignes[$N])		{ $Sortie .= "<dt>".$Elements[$N]."</dt>"; }
				else					{ $Sortie .= "<dd>".$Elements[$N]."</dd>"; }
				}
	
			$Sortie .= "</dl>";
			}
		else	{ $Sortie .= $Elements[0]; }
		$Sortie .= "</div>";

		$Sortie .= "</div>";
		}
	
	return $Sortie;
	}

?>
