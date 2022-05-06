<?php

function rapport( $Texte, $Get )
	{
	$Brut = array();
	$Original = $Texte;
	
	/* Uniformisation de l'input */
	$Texte = fonction("rapport_preTraitement", array($Texte));

	/* Données générales */
	$Brut = fonction("rapport_meta", array($Brut, $Texte));

	/* Données d'unités */	
	$Brut = fonction("rapport_des", array($Brut, $Texte));

	/* Estimation des unités ennemies */	
	$Brut = fonction("rapport_estiDef", array($Brut, $Texte));

	/* Mise en forme du rapport */
	$Texte = fonction("rapport_format", array($Brut, $Texte));

	/* Données du joueur ennemi */
	$Brut = fonction("rapport_joueur", array($Brut, $Get));

	/* Elements de résumé */
	$Elements = fonction("rapport_elements", array($Brut, ",", "."));
	
	if (isset($GLOBALS['alerte']))
		{
		/* Alerte */
		$GLOBALS['dialogues'][] = array(
			"type" => "erreur",
			"message" => "Votre Rapport a généré une erreur, si vous ne comprenez pas pourquoi prévenez un administrateur"
			);
		return FALSE;
		}
	else
		{
		return array(
			"original" => $Original,
			"elements" => $Elements,
			"joint" => $Texte
			);
		}
	}

?>
