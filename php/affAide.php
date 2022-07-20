<?php

function affAide()
	{
	$Texte = "
		<div id=\"body\" class=\"texte\">

			<p>Le r�seau de Renseignement Inter Clan Automatis� (RICA) est un service non officiel offert aux joueurs de <a href=\"http://www.ngswing.com\" target=\"_blank\">Star Wars in New Generation</a>. Il permet (entre autres) de recenser et extraire automatiquement les informations importantes des rapports de combat, afin de faciliter la coop�ration et la recherche de cibles. Ce service est propos� � l'identique aux 3 clans au sein d'une m�me interface, les rapports et acc�s �tant soigneusement cloisonn�s.</p>
			
			<br>
			
			<a href=\"#C1\">1. Aide rapide</a><br>
			<a href=\"#C2\">2. Ajouter un Combat</a><br>
			<a href=\"#C3\">3. Ajouter une Carte</a><br>
			<a href=\"#C4\">4. Effectuer une recherche</a><br>
			<a href=\"#C5\">5. Rapports de combat</a><br>
			<a href=\"#C6\">6. Cartes d�taill�es</a><br>
			<a href=\"#C7\">7. Consid�rations techniques</a><br>

			<br>
			<br>
			
			<a class=\"chapitre\" name=\"C1\">1. Aide rapide</a>
			<p>L'<span class=\"clef\">interface</span> se d�compose en deux parties ind�pendantes : la partie sup�rieure contient un onglet par action que vous pouvez effectuer, la partie inf�rieure un onglet par affichage que RICA peut g�n�rer. Chaque onglet sup�rieur contient un petit <span class=\"clef\">r�sum� des fondamentaux</span> pour l'action consid�r�e. <span class=\"clef\">Le bouton � l'effigie de votre clan</span> avec votre pseudo vous permet de vous d�connecter (et de supprimer votre connexion automatique si vous l'aviez demand�e). Les <span class=\"clef\">r�sultats de recherche</span> se pr�sentent sous forme de liste, chaque ligne correspond � une entr�e (un rapport de combat, une carte ...), cliquez sur son titre pour voir les informations extraites, cliquez sur le trombone dor� pour acc�der � l'entr�e compl�te. Notez qu'une recherche par mot cl� affiche directement les informations extraites pertinentes par d�faut.</p>

			<br>

			<a class=\"chapitre\" name=\"C2\">2. Ajouter un Combat</a>
			<p>Ajoutez vos rapports de combat pour permettre � vos co�quipiers de profiter des compositions ennemies et d'une analyse pouss�e du combat (unit�s restantes, puissance � vide ...).</p>
			<p>S�lectionnez le rapport de combat sur SWING ou dans votre boite mail, copiez (Ctrl + C) puis collez (Ctrl + V) dans la boite � fond gris de l'onglet \"Ajouter un combat\". Vous pouvez modifier le date pour la faire coincider avec l'heure exacte du combat et non plus de l'envoi. Vous pouvez �galement entrer dans le champs \"Puissance\" la puissance restante de la cible, qui sera ainsi plus pr�cise que l'approximation g�n�r�e par RICA. Appuyez enfin sur \"Ajouter\". Le rapport doit �tre <span class=\"clef\">complet</span>, c'est � dire commencer au moins � \"Votre flotte attaque ...\" et se terminer apr�s les gains d'exp�rience voir les passagers lib�r�s. Il peut s'agir de rapports d'attaque ou de d�fense, aussi bien spatiaux que plan�taires. Le rapport envoy� sera analys� et apparaitra sous la forme d'un r�sum�, voir les chapitres 4 et 5 pour plus d'informations.</p>

			<br>

			<a class=\"chapitre\" name=\"C3\">3. Ajouter une Carte</a>
			<p>Une carte g�n�r�e depuis votre flotte ou une de vos plan�tes peut �tre utile pour donner � vos co�quipiers une vue d�taill�e de la situation dans un coin de la galaxie o� ils ne se trouvent pas actuellement.</p>
			<p>Placez vous sur une page de SWING o� une carte d�taill�e est visible (\"D�placement et Combats\" ou vue de plan�te depuis le \"Planetarium\"), puis copiez le <span class=\"clef\">code HTML</span> ou \"code source\" de la page et collez le dans la boite � fond gris. Sous Firefox vous pouvez utiliser les raccourcis suivants : Ctrl + U pour ouvrir l'affichage du code, Ctrl + A pour tout s�lectionner, Ctrl + C pour copier, puis Ctrl + V pour coller une fois la page de RICA ouverte (onglet \"Ajouter une carte\"). Vous pouvez modifier la date si vous le souhaitez. Appuyez enfin sur \"Ajouter\" pour que le screenshot soit analys�.</p>
			<p>Comme pour les rapports de combats, un r�sum� sera affich� dans l'interface (r�sum� contenant la liste des flottes et plan�tes identifi�es sur l'image) et une vision d�taill�e sera disponible.</p>

			<br>

			<a class=\"chapitre\" name=\"C4\">4. Effectuer une recherche</a>
			<p>La recherche se fait par mot cl�, comme sur un moteur de recherche classique (Google ...). Pour chaque entr�e, un certain nombre d'informations pertinentes sont mises de cot� pour la recherche, au sein desquels les mots cl�s que vous demandez seront recherch�s.</p>
			<p>A la diff�rence de Google, il s'agit d'une recherche <span class=\"clef\">exacte</span>, c'est � dire que tous les mots que vous demandez devront se trouver dans un message pour qu'il soit s�lectionn�, et ces mots devront s'y trouver tels que vous les avez �crits (les majuscules et minuscules n'ont pas d'importance).</p>
			<p>Notez que les <span class=\"clef\">espaces</span> font partie des mots cl�s, si vous souhaitez afficher les messages qui contiennent deux mots cl�s � des endroits diff�rents vous devrez les s�parer par des <span class=\"clef\">signes +</span>. Vous pouvez �galement exclure de la recherche les messages qui contiennent un mot cl�, en faisant pr�c�der le mot cl� en question du <span class=\"clef\">signe !</span>.</p>
			<p>Pour interroger un champs particulier, vous pouvez entrer son nom comme mot cl�. Ainsi si l'on souhaite retrouver un joueur qui s'appelle \"Swing\", on privil�giera une recherche <span class=\"clef\">Joueur : Swing</span> � une simple recherche de ce pseudo, qui nous renverrait tous les rapports de combat � cause de l'URL de ngswing contenue dans les liens vers les fiches de joueur. En r�gle g�n�rale pr�f�rez les menus d�roulants aux recherches manuelles, ils contiennent d�ja les mots cl�s ad�quats.</p>
			<p>Par exemple, la recherche <span class=\"clef\">Flotte + Joueur : Kin + !Secteur : C3</span> affichera tous les messages (combats et cartes) qui concernent la flotte du joueur Kin dans un secteur autre que le secteur C3.</p>

			<br>

			<a class=\"chapitre\" name=\"C5\">5. Rapports de combat</a>
			<p>Pour chaque rapport que vous entrez, de nombreuses informations en sont extraites ou r�colt�es par d'autres moyens puis condens�es sous la forme d'un message qui sera affich� lors des recherches. Ces messages se composent d'un titre, qui permet d'afficher les informations d�taill�e lorsque vous <span class=\"clef\">cliquez</span> dessus et de voir le <span class=\"clef\">rapport complet</span> dont le lien est donn� dans les informations d�taill�es. Ce titre donne le r�sultat du combat (Victoire, D�faite, Destruction, Capture, Meurtre), le type de cible (Flotte, Plan�te), le nom du joueur cibl� et la position de l'objet attaqu�.</p>
			<p>Notez que les coordonn�es sont fournies en couple <span class=\"clef\">X/-Y</span>, mais �galement en terme de secteur. Pour m�moire, la lettre correspond � la colonne et le chiffre � la ligne sur la carte de la galaxie. B3 et D3 n'existent pas, ils sont r�pertori�s respectivement comme <span class=\"clef\">Coruscant</span> et <span class=\"clef\">Hoth</span>. Le nom et le num�ro de la cible sont �galement rappel�s.</p>
			<p>Les passagers sont �galement r�pertori�s, dans la rubrique <span class=\"clef\">VIP alli�</span> lorsqu'il s'agit d'un passager utilis� par le posteur du rapport, <span class=\"clef\">VIP ennemi</span> sinon. Est �galement rappel� dans cette rubrique l'unit� sur laquelle le passager a �t� rep�r�. V�rifiez si cette unit� se trouve dans une rubrique \"Restent\" pour savoir si le passage ennemi a �t� lib�r� ou non.</p>
			<p>Vous trouverez dans les informations d�taill�es un lien vers la fiche du joueur attaqu�, ainsi que son <span class=\"clef\">nombre de tours jou�s</span> qui y figure au moment o� le rapport est envoy� � la BDD. Une estimation de la <span class=\"clef\">Puissance � Vide</span> � partir des informations publiques (parsecs, plan�tes) est �galement calcul�e, sous forme d'un intervalle de confiance � 100% (le minimum correspond � des recherches du niveau de la plus haute unit� rencontr�e lors du combat et aucun b�timent, le maximum � des recherches et des parsecs complets). Prenez donc l'habitude de les envoyer imm�diatement, sans quoi ces informations seront erronn�es.</p>
			<p>La base de donn�es tentera �galement de d�terminer le <span class=\"clef\">nombre d'unit�s survivantes</span>. Ce calcul repose sur les caract�ristiques des unit�s et le traitement du texte du rapport, et n'est donc pas fiable � 100%, mais permet d'avoir une estimation pr�cise des unit�s restantes et donc des <span class=\"clef\">unit�s ennemies en d�but de combat</span> (colonne Etat Actuel), y compris lorsque des coups critiques ou des blocages entrent en jeu. Ce service �tant encore assez jeune, n'h�sitez pas � signaler les rapports o� il vous semble incorrect pour am�lioration. Grace � cette estimation et � celle de la Puissance � Vide, une estimation de la <span class=\"clef\">puissance restante</span> est �galement calcul�e (� moins qu'elle n'ai �t� entr�e lors de l'envoi, les estimations sont facile � reconnaitre, elles sont donn�es sous la forme d'un nombre de millions, avec une seule d�cimale). Notez que le m�me algorithme est appliqu� � vos propres unit�s sans prendre en consid�ration les donn�es suppl�mentaires disponibles (Etat Actuel en d�but de combat), il est donc possible que vous notiez de l�g�res diff�rences.</p>
			<p>Pour chaque unit� participant au combat est affich� un <span class=\"clef\">pourcentage</span> en vie et en d�gats. Ce pourcentage traduit de la position des d�s tir�s (bonus compris) dans la fourchette de l'unit�. Ainsi une unit� tirant le minimum possible en vie aura \"0%\", une unit� tirant le maximum \"100%\". Bien �videmment il est possible de d�passer 100% avec des bonus (PDF, VIP, reliques, niveaux ...).</p>

			<br>

			<a class=\"chapitre\" name=\"C6\">6. Cartes d�taill�es</a>
			<p>Lorsque vous ajoutez une carte, une image proche de celle affich�e dans SWING est recr��e � partir des informations extraites. Contrairement � SWING, les informations sur les flottes et plan�tes sont affich�es dans un tableau en dessous de l'image. Cliquez sur l'<span class=\"clef\">image d'un objet</span> ou sur ses <span class=\"clef\">coordonn�es</span> dans le tableau pour mettre en valeur l'image et la l�gende correspondante. Les <span class=\"clef\">pseudo</span> des joueurs sont des liens directs vers leurs fiches SWING, les <span class=\"clef\">num�ros</span> des flottes ou plan�tes des liens vers une recherche de l'objet en question dans RICA.</p>

			<br>

			<a class=\"chapitre\" name=\"C7\">7. Consid�rations techniques</a>
			<p>Pour toute <span class=\"clef\">suggestion, question ou alerte concernant un bug</span>, utilisez l'onglet \"Discussions\". V�rifiez qu'un sujet traitant de votre probl�me n'existe pas d�ja, si non cr�ez en un (un seul sujet par probl�me !) avec un titre explicite. Vous pouvez �galement contacter Nem ou Mythik sur Slack (ngswing.slack.com) en cas d'impossibilit� ou s'il s'agit d'une faille pouvant �tre exploit�e. Soyez pr�cis en d�crivant les circonstances ayant caus� le bug, de mani�re � ce qu'il puisse �tre reproduit. S'il s'agit d'un rapport de combat qui pause probl�me, merci de le joindre au message sous forme d'une pi�ce jointe au format txt.</p>
			<p>Certaines fonctions de consultation utilisent la technologie <span class=\"clef\">JavaScript</span>. Vous pouvez utiliser RICA en ayant d�sactiv� cette technologie, n�anmoins il vous est conseill� pour une utilisation plus agr�able d'autoriser RICA � l'employer (c'est le cas par d�faut).</p>
		</div>";
	
	return $Texte;
	}

?>
