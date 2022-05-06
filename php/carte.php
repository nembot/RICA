<?php

function carte( $Texte )
	{
	$Brut = array();
	$Original = $Texte;
	
	/* Uniformisation de l'input */
	$Texte = fonction("carte_preTraitement", array($Texte));

	/* Données générales */
	$Brut = fonction("carte_meta", array($Brut, $Texte));

	/* Processing case par case */
	$Brut = fonction("carte_parse", array($Brut, $Texte));

	/* Mise en forme de la carte */
	$Texte = fonction("carte_format", array($Brut));

	/* Elements de résumé */
	$Elements = fonction("carte_elements", array($Brut));

	if (isset($GLOBALS['alerte']))
		{
		/* Alerte */
		$GLOBALS['dialogues'][] = array(
			"type" => "erreur",
			"message" => "Votre Carte a généré une erreur, si vous ne comprenez pas pourquoi prévenez un administrateur"
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
