<?php

function memo( $Titre, $Joueur, $X, $Y, $Secteur, $Type, $Nom, $Numero, $Details )
	{
	$Titre = fonction("signes", array($Titre));
	if ($Titre != "")
		{
		# Eléments communs
		$Elements = array(
			array(
				"nom" => "",
				"contenu" => $Titre
				),
			array(
				"nom" => "Ajouté par",
				"contenu" => $_SESSION['pseudo']
				),
			array(
				"nom" => "Type",
				"contenu" => "Memo"
				)
			);
		
		# Joueur + Clan
		$Joueur = fonction("signes", array($Joueur));
		if (preg_match("#^(.+);(.+?)$#", $Joueur, $M))
			{
			$Elements[] = array(
				"nom" => "Joueur",
				"contenu" => $M[1]
				);
			$Elements[] = array(
				"nom" => "Clan",
				"contenu" => $M[2]
				);
			}
		
		# Position
		if (preg_match("#^([0-9]+)$#", $X, $Xm) AND preg_match("#^\-? ?([0-9]+)$#", $Y, $Ym))
			{
			$Elements[] = array(
				"nom" => "Position",
				"contenu" => $Xm[1]."/-".$Ym[1]
				);
			$Elements[] = array(
				"nom" => "Secteur",
				"contenu" => fonction("secteur", array($Xm[1], $Ym[1]))
				);
			}
		
		# Secteur seul
		$Secteurs = array(
			"A1","A2","A3","A4","A5",
			"B1","B2","Coruscant","B4","B5",
			"C1","C2","C3","C4","C5",
			"D1","D2","Hoth","D4","D5",
			"E1","E2","E3","E4","E5"
			);
		if (in_array($Secteur, $Secteurs))
			{
			$Elements[] = array(
				"nom" => "Secteur",
				"contenu" => $Secteur
				);
			}
		
		# Objet
		$Type = fonction("signes", array($Type));
		$Nom = fonction("signes", array($Nom));
		$Numero = fonction("signes", array($Numero));
		if ($Type != "" AND ($Nom != "" OR $Numero != ""))
			{
			$Elements[] = array(
				"nom" => $Type,
				"contenu" => $Nom." (".$Numero.")"
				);
			}
		
		# Détails
		$Details = fonction("signes", array($Details));
		if ($Details != "")
			{
			$Elements[] = array(
				"nom" => "Détails",
				"contenu" => $Details
				);
			}
		
		return array(
			"original" => "",
			"elements" => $Elements,
			"joint" => ""
			);
		}
	else { $GLOBALS['dialogues'][] = array("type" => "erreur", "message" => "Choisissez un Titre à votre Memo"); return FALSE; }
	}

?>
