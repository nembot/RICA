<?php

function affBody()
	{
	$Body = "";

	/* Page selectionnée */
	if (isset($_GET['P']))	{ $Page = $_GET['P']; }
	else					{ $Page = ""; }

	/* Onglets - Paramètres */
	if (!isset($_SESSION['pseudo']))
		{
		$Pages = array(
			"inscription" =>	array( "label" => "Inscription",						"lien" => TRUE	),
			"recherche" =>		array( "label" => "Recherche",	"class" => "verrouille"				),
			"unites" =>		array( "label" => "Unités",							"lien" => TRUE	),
			"bonus" =>		array( "label" => "Bonus",							"lien" => TRUE ),
			"vip" =>			array( "label" => "VIP",			"class" => "verrouille"				),
			"stats" =>		array( "label" => "Statistiques",						"lien" => TRUE ),
			"suggestions" =>	array( "label" => "Suggestions",	"class" => "verrouille"				),
			"aide" =>			array( "label" => "Aide",							"lien" => TRUE ),
			"erreur" =>		array(														)
			);

		/* Par défaut */
		if (!isset($Pages[ $Page ]))	{ $Page = "inscription"; }
		}
	else
		{
		$Pages = array(
			"inscription" =>	array( "label" => "Inscription",						"lien" => TRUE ),
			"recherche" =>		array( "label" => "Recherche",						"lien" => TRUE ),
			"unites" =>		array( "label" => "Unités",							"lien" => TRUE ),
			"bonus" =>		array( "label" => "Bonus",							"lien" => TRUE ),
			"vip" =>			array( "label" => "VIP",								"lien" => TRUE ),
			"stats" =>		array( "label" => "Statistiques",						"lien" => TRUE ),
			"suggestions" =>	array( "label" => "Suggestions",						"lien" => TRUE ),
			"aide" =>			array( "label" => "Aide",							"lien" => TRUE ),
			"erreur" =>		array(														)
			);

		/* Suggestions non lues */
		$Pages['suggestions']['label'] .= " (".fonction("nonLus_total").")";

		/* Par défaut */
		if (!isset($Pages[ $Page ]))		{ $Page = "recherche"; }
		}

	/* Onglets - Selection */
	if (isset($Pages[ $Page ]['class']))	{ $Pages[ $Page ]['class'] .= " selection"; }
	else								{ $Pages[ $Page ]['class'] = "selection"; }

	/* Onglets - Ajout */
	$Body .= fonction("affOnglets", array($Pages, "ongletsBody"));

	/* Contenu */
	switch($Page)
		{
		case "inscription":	$Body .= fonction("affInscription");	break;
		case "recherche":	$Body .= fonction("affRecherche");		break;
		case "unites":		$Body .= fonction("affUnites");		break;
		case "bonus":		$Body .= fonction("affBonus");		break;
		case "vip":		$Body .= fonction("affVIP");			break;
		case "stats":		$Body .= fonction("affStats");		break;
		case "suggestions":	$Body .= fonction("affSuggestions");	break;
		case "aide":		$Body .= fonction("affAide");			break;
		case "erreur":		$Body .= fonction("affErreur");		break;
		}

	return $Body;
	}

?>
