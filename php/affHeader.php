<?php

function affHeader()
	{
	$Header = "";

	/* Onglets */
	$Pages = array(
		"recherche" =>	array("label" => "Rechercher"),
		"combat" =>	array("label" => "Ajouter un Combat"),
		"carte" =>	array("label" => "Ajouter une Carte"),
		"memo" =>		array("label" => "Ajouter un Memo"),
		"discuter" =>	array("label" => "Discuter")
		);

	if (!isset($_SESSION['pseudo']))
		{
		/* Onglets verrouill�s */
		foreach($Pages as &$P)	{ $P['class'] = "verrouille"; }

		/* Affichage des onglets */
		$Header .= fonction("affOnglets", array($Pages, "ongletsHeader"));

		/* Header */
		$Header .= fonction("header_connexion");
		}
	else
		{
		/* Onglets cliquables */
		foreach($Pages as &$P)	{ $P['click'] = TRUE; }

		/* Onglet visible */
		if (isset($_GET['P']) AND $_GET['P'] == "suggestions")		{ $Pages['discuter']['class'] = "selection"; }
		else												{ $Pages['recherche']['class'] = "selection"; }

		/* Affichage des onglets */
		$Header .= fonction("affOnglets", array($Pages, "ongletsHeader"));

		/* D�but */
		$Header .= "
		<div id=\"header\">
			<a href=\"index.php?Deconnexion=1\" class=\"".$_SESSION['clan']."\" id=\"blason\" title=\"Déconnexion\">".$_SESSION['pseudo']."</a>
			";

		/* El�ments */
		$Header .= fonction("header_recherche", array($Pages));
		$Header .= fonction("header_combat", array($Pages));
		$Header .= fonction("header_carte", array($Pages));
		$Header .= fonction("header_memo", array($Pages));
		$Header .= fonction("header_discuter", array($Pages));

		/* Fin */
		$Header .= "
		</div>";
		}

	return $Header;
	}

?>
