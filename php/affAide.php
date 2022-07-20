<?php

function affAide()
	{
	$Texte = "
		<div id=\"body\" class=\"texte\">

			<p>Le réseau de Renseignement Inter Clan Automatisé (RICA) est un service non officiel offert aux joueurs de <a href=\"http://www.ngswing.com\" target=\"_blank\">Star Wars in New Generation</a>. Il permet (entre autres) de recenser et extraire automatiquement les informations importantes des rapports de combat, afin de faciliter la coopération et la recherche de cibles. Ce service est proposé à l'identique aux 3 clans au sein d'une même interface, les rapports et accès étant soigneusement cloisonnés.</p>

			<br>

			<a href=\"#C1\">1. Aide rapide</a><br>
			<a href=\"#C2\">2. Ajouter un Combat</a><br>
			<a href=\"#C3\">3. Ajouter une Carte</a><br>
			<a href=\"#C4\">4. Effectuer une recherche</a><br>
			<a href=\"#C5\">5. Rapports de combat</a><br>
			<a href=\"#C6\">6. Cartes détaillées</a><br>
			<a href=\"#C7\">7. Considérations techniques</a><br>

			<br>
			<br>

			<a class=\"chapitre\" name=\"C1\">1. Aide rapide</a>
			<p>L'<span class=\"clef\">interface</span> se d�compose en deux parties indépendantes : la partie supérieure contient un onglet par action que vous pouvez effectuer, la partie inférieure un onglet par affichage que RICA peut g�n�rer. Chaque onglet supérieur contient un petit <span class=\"clef\">résumé des fondamentaux</span> pour l'action considérée. <span class=\"clef\">Le bouton à l'effigie de votre clan</span> avec votre pseudo vous permet de vous déconnecter (et de supprimer votre connexion automatique si vous l'aviez demandée). Les <span class=\"clef\">résultats de recherche</span> se présentent sous forme de liste, chaque ligne correspond à une entrée (un rapport de combat, une carte ...), cliquez sur son titre pour voir les informations extraites, cliquez sur le trombone doré pour accéder à l'entrée complète. Notez qu'une recherche par mot clé affiche directement les informations extraites pertinentes par défaut.</p>

			<br>

			<a class=\"chapitre\" name=\"C2\">2. Ajouter un Combat</a>
			<p>Ajoutez vos rapports de combat pour permettre à vos coéquipiers de profiter des compositions ennemies et d'une analyse poussée du combat (unités restantes, puissance à vide ...).</p>
			<p>Sélectionnez le rapport de combat sur SWING ou dans votre boite mail, copiez (Ctrl + C) puis collez (Ctrl + V) dans la boite à fond gris de l'onglet \"Ajouter un combat\". Vous pouvez modifier le date pour la faire coincider avec l'heure exacte du combat et non plus de l'envoi. Vous pouvez également entrer dans le champs \"Puissance\" la puissance restante de la cible, qui sera ainsi plus précise que l'approximation générée par RICA. Appuyez enfin sur \"Ajouter\". Le rapport doit être <span class=\"clef\">complet</span>, c'est à dire commencer au moins à \"Votre flotte attaque ...\" et se terminer après les gains d'expérience voir les passagers libérés. Il peut s'agir de rapports d'attaque ou de défense, aussi bien spatiaux que planétaires. Le rapport envoyé sera analysé et apparaitra sous la forme d'un résumé, voir les chapitres 4 et 5 pour plus d'informations.</p>

			<br>

			<a class=\"chapitre\" name=\"C3\">3. Ajouter une Carte</a>
			<p>Une carte générée depuis votre flotte ou une de vos planètes peut être utile pour donner à vos coéquipiers une vue détaillée de la situation dans un coin de la galaxie où ils ne se trouvent pas actuellement.</p>
			<p>Placez vous sur une page de SWING où une carte détaillée est visible (\"Déplacement et Combats\" ou vue de planète depuis le \"Planetarium\"), puis copiez le <span class=\"clef\">code HTML</span> ou \"code source\" de la page et collez le dans la boite à fond gris. Sous Firefox vous pouvez utiliser les raccourcis suivants : Ctrl + U pour ouvrir l'affichage du code, Ctrl + A pour tout sélectionner, Ctrl + C pour copier, puis Ctrl + V pour coller une fois la page de RICA ouverte (onglet \"Ajouter une carte\"). Vous pouvez modifier la date si vous le souhaitez. Appuyez enfin sur \"Ajouter\" pour que le screenshot soit analysé.</p>
			<p>Comme pour les rapports de combats, un résumé sera affiché dans l'interface (résumé contenant la liste des flottes et planètes identifiées sur l'image) et une vision détaillée sera disponible.</p>

			<br>

			<a class=\"chapitre\" name=\"C4\">4. Effectuer une recherche</a>
			<p>La recherche se fait par mot clé, comme sur un moteur de recherche classique (Google ...). Pour chaque entrée, un certain nombre d'informations pertinentes sont mises de coté pour la recherche, au sein desquels les mots clés que vous demandez seront recherchés.</p>
			<p>A la différence de Google, il s'agit d'une recherche <span class=\"clef\">exacte</span>, c'est à dire que tous les mots que vous demandez devront se trouver dans un message pour qu'il soit sélectionné, et ces mots devront s'y trouver tels que vous les avez écrits (les majuscules et minuscules n'ont pas d'importance).</p>
			<p>Notez que les <span class=\"clef\">espaces</span> font partie des mots clés, si vous souhaitez afficher les messages qui contiennent deux mots clés à des endroits différents vous devrez les séparer par des <span class=\"clef\">signes +</span>. Vous pouvez également exclure de la recherche les messages qui contiennent un mot clé, en faisant précéder le mot clé en question du <span class=\"clef\">signe !</span>.</p>
			<p>Pour interroger un champs particulier, vous pouvez entrer son nom comme mot clé. Ainsi si l'on souhaite retrouver un joueur qui s'appelle \"Swing\", on privilégiera une recherche <span class=\"clef\">Joueur : Swing</span> à une simple recherche de ce pseudo, qui nous renverrait tous les rapports de combat à cause de l'URL de ngswing contenue dans les liens vers les fiches de joueur. En règle générale préférez les menus déroulants aux recherches manuelles, ils contiennent déja les mots clés adéquats.</p>
			<p>Par exemple, la recherche <span class=\"clef\">Flotte + Joueur : Kin + !Secteur : C3</span> affichera tous les messages (combats et cartes) qui concernent la flotte du joueur Kin dans un secteur autre que le secteur C3.</p>

			<br>

			<a class=\"chapitre\" name=\"C5\">5. Rapports de combat</a>
			<p>Pour chaque rapport que vous entrez, de nombreuses informations en sont extraites ou récoltées par d'autres moyens puis condensées sous la forme d'un message qui sera affiché lors des recherches. Ces messages se composent d'un titre, qui permet d'afficher les informations d�taill�e lorsque vous <span class=\"clef\">cliquez</span> dessus et de voir le <span class=\"clef\">rapport complet</span> dont le lien est donné dans les informations détaillées. Ce titre donne le résultat du combat (Victoire, Défaite, Destruction, Capture, Meurtre), le type de cible (Flotte, Plan�te), le nom du joueur ciblé et la position de l'objet attaqué.</p>
			<p>Notez que les coordonnées sont fournies en couple <span class=\"clef\">X/-Y</span>, mais également en terme de secteur. Pour mémoire, la lettre correspond à la colonne et le chiffre à la ligne sur la carte de la galaxie. B3 et D3 n'existent pas, ils sont répertoriés respectivement comme <span class=\"clef\">Coruscant</span> et <span class=\"clef\">Hoth</span>. Le nom et le numéro de la cible sont également rappelés.</p>
			<p>Les passagers sont également répertoriés, dans la rubrique <span class=\"clef\">VIP allié</span> lorsqu'il s'agit d'un passager utilisé par le posteur du rapport, <span class=\"clef\">VIP ennemi</span> sinon. Est également rappelé dans cette rubrique l'unité sur laquelle le passager a été repéré. Vérifiez si cette unité se trouve dans une rubrique \"Restent\" pour savoir si le passage ennemi a été libéré ou non.</p>
			<p>Vous trouverez dans les informations détaillées un lien vers la fiche du joueur attaqué, ainsi que son <span class=\"clef\">nombre de tours joués</span> qui y figure au moment où le rapport est envoyé à la BDD. Une estimation de la <span class=\"clef\">Puissance à Vide</span> à partir des informations publiques (parsecs, planètes) est également calculée, sous forme d'un intervalle de confiance à 100% (le minimum correspond à des recherches du niveau de la plus haute unité rencontrée lors du combat et aucun bâtiment, le maximum à des recherches et des parsecs complets). Prenez donc l'habitude de les envoyer immédiatement, sans quoi ces informations seront erronnées.</p>
			<p>La base de données tentera également de déterminer le <span class=\"clef\">nombre d'unités survivantes</span>. Ce calcul repose sur les caractéristiques des unités et le traitement du texte du rapport, et n'est donc pas fiable à 100%, mais permet d'avoir une estimation précise des unités restantes et donc des <span class=\"clef\">unités ennemies en début de combat</span> (colonne Etat Actuel), y compris lorsque des coups critiques ou des blocages entrent en jeu. Ce service étant encore assez jeune, n'hésitez pas à signaler les rapports où il vous semble incorrect pour amélioration. Grace à cette estimation et à celle de la Puissance à Vide, une estimation de la <span class=\"clef\">puissance restante</span> est également calculée (à moins qu'elle n'ai été entrée lors de l'envoi, les estimations sont facile à reconnaitre, elles sont données sous la forme d'un nombre de millions, avec une seule d�cimale). Notez que le même algorithme est appliqué à vos propres unités sans prendre en considération les données supplémentaires disponibles (Etat Actuel en début de combat), il est donc possible que vous notiez de légères différences.</p>
			<p>Pour chaque unité participant au combat est affiché un <span class=\"clef\">pourcentage</span> en vie et en dégats. Ce pourcentage traduit de la position des dés tirés (bonus compris) dans la fourchette de l'unité. Ainsi une unité tirant le minimum possible en vie aura \"0%\", une unité tirant le maximum \"100%\". Bien évidemment il est possible de dépasser 100% avec des bonus (PDF, VIP, reliques, niveaux ...).</p>

			<br>

			<a class=\"chapitre\" name=\"C6\">6. Cartes détaillées</a>
			<p>Lorsque vous ajoutez une carte, une image proche de celle affichée dans SWING est recréée à partir des informations extraites. Contrairement à SWING, les informations sur les flottes et planètes sont affichées dans un tableau en dessous de l'image. Cliquez sur l'<span class=\"clef\">image d'un objet</span> ou sur ses <span class=\"clef\">coordonnées</span> dans le tableau pour mettre en valeur l'image et la légende correspondante. Les <span class=\"clef\">pseudo</span> des joueurs sont des liens directs vers leurs fiches SWING, les <span class=\"clef\">numéros</span> des flottes ou planètes des liens vers une recherche de l'objet en question dans RICA.</p>

			<br>

			<a class=\"chapitre\" name=\"C7\">7. Consid�rations techniques</a>
			<p>Pour toute <span class=\"clef\">suggestion, question ou alerte concernant un bug</span>, utilisez l'onglet \"Discussions\". Vérifiez qu'un sujet traitant de votre problème n'existe pas déja, si non créez en un (un seul sujet par problème !) avec un titre explicite. Vous pouvez également contacter Nem par Message Privé sur SWING ou via slack en cas d'impossibilité ou s'il s'agit d'une faille pouvant être exploitée. Soyez précis en décrivant les circonstances ayant causé le bug, de manière à ce qu'il puisse être reproduit. S'il s'agit d'un rapport de combat qui pause problème, merci de le joindre au message sous forme d'une pièce jointe au format txt.</p>
			<p>Certaines fonctions de consultation utilisent la technologie <span class=\"clef\">JavaScript</span>. Vous pouvez utiliser RICA en ayant désactivé cette technologie, néanmoins il vous est conseillé pour une utilisation plus agréable d'autoriser RICA à l'employer (c'est le cas par défaut).</p>
		</div>";

	return $Texte;
	}

?>
