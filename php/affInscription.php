<?php

function affInscription()
	{
	/* Connexion */
	$Texte = "
		<div id=\"body\" class=\"texte\">

			<form action=\"\" method=\"post\">

				<a class=\"chapitre\">1. Choisissez votre identit�</a>
				<p>Votre compte RICA sera lié à votre compte SWING, choisissez son pseudo dans la liste suivante. Cette liste est tenue à jour à partir du classement, il y a donc un délai entre votre (ré)inscription sur SWING et la disponibilité de votre pseudo dans cette liste. Si l'absence de votre pseudo persiste plus de 24h, contactez un administrateur.<br>
				<br>
				<select name=\"identite\" onClick=\"selectJoueur(this, 'ids')\"><option value=\"\">Votre pseudo SWING</select></p>

				<br>

				<a class=\"chapitre\">2. Confirmez votre identité</a>
				<p>Afin de prouver votre identité et d'attribuer un mot de passe à votre compte RICA, vous devez placer la phrase suivante dans la description de votre compte SWING (Divers / Options / Votre description) : <span class=\"clef\">Membre du Réseau RICA</span>. Votre clan sera déterminé automatiquement, et une mise à jour de vos accés sera effectuée régulièrement, y compris en début de partie où vous n'aurez donc pas à vous réinscrire.</p>

				<br>

				<a class=\"chapitre\">3. Choisissez un mot de passe</a>
				<p>Ce mot de passe vous sera demandé à chaque connexion au Réseau RICA. Préférez des mots de passe longs (plus de 6 caractères), qui contiennent des caractères inhabituels (chiffres, majuscules, ponctuation ...). Evitez également d'utiliser le même mot de passe que pour SWING. Ce sont les renseignement de tout votre clan qui sont en jeu !<br>
				<br>
				<input name=\"pass\" type=\"password\"></p>

				<br>

				<a class=\"chapitre\">4. Jettez un oeil � l'Aide</a>
				<p>Même si beaucoup d'efforts ont été faits pour rendre l'utilisation du Réseau aussi simple que possible, il vous est vivement conseillé de lire le paragraphe <span class=\"clef\">Aide rapide</span> de la page d'aide (onglet au milieu à droite). N'hésitez pas à lire les autres paragraphes pour une utilisation avancée de cet outil.</p>

				<br>

				<a class=\"chapitre\">5. <input name=\"inscription\" type=\"submit\" class=\"submit\" value=\"Terminer l'inscription\"></a>

			</form>

		</div>";

	return $Texte;
	}

?>
