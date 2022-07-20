<?php

function affErreur()
	{
	$Texte = "
		<div id=\"body\">
			<a class=\"chapitre\">Une erreur est survenue</a><br>
			<br>
			<p>L'opération que vous avez effectué a entrainé une erreur. Merci de contacter un administrateur et de lui expliquer les circonstances de cette erreur afin qu'elle ne se reproduise pas à l'avenir. Fournissez suffisament de détails pour que l'erreur puisse être reproduite, dont notamment toute donnée que vous auriez pu envoyer (rapport de combat, source HTML d'une carte ...).<br>
			<br>
			Désolé pour ce désagrément</p>
		</div>";

	return $Texte;
	}
