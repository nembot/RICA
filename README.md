# Réseau de Renseignement Inter-Clan Automatisé (RICA)

RICA est une base de données inter-clan pour le jeu en ligne [SWING](https://www.ngswing.com).

Son objectif est de fournir aux 3 clans du jeu (Rebellion, Empire et Contrebande) les mêmes services de collecte et analyse des rapports de combat, en compartimentant les informations collectées pour chaque clan.

Développé initialement par Ziliev et hébergé à l'adresse https://rica.ovsa.fr, le réseau original a fermé ses portes le 4 mai 2022.

![Apercu](https://github.com/maressyl/RICA/raw/main/screenshots/Apercu_600.png)

*Sélection de captures d'écrans disponibles dans `screenshots`.*

# Installation

## Mise en garde

RICA a été développé durant mes jeunes années, à ce titre de nombreux choix d'implémentations qui ont été fait sont discutables et peuvent potentiellement constituer des failles de sécurité. Le code source et mis à disposition "tel quel" et sans garantie aucune.

## Pré-requis

RICA a été mis à jour pour la dernière fois pour touner sur un serveur Ubuntu 18.04 LTS, comprenant notamment :
- PHP 7.2
- MariaDB 10.3.34
- Apache 2.4.41-4

Le portage vers une version plus récente de PHP reste à effectuer.

Le module GD de PHP est également requis.

## Installation

1. Cloner le dépôt git sur le serveur (`/var/www/rica` dans cet exemple).

2. Restreindre les permissions sur les fichiers :

```bash
sudo chown www-data:www-data -R /var/www/rica
sudo find /var/www/rica -type d -exec chmod 555 "{}" +
sudo find /var/www/rica -type f -exec chmod 444 "{}" +
sudo chmod u+w /var/www/rica/crons_log.txt
sudo chmod u+w /var/www/rica/logs
sudo chmod u+w /var/www/rica/dumps
sudo chmod u+w -R /var/www/rica/statistiques
sudo chmod u+w /var/www/rica/imports/joueurs.js.php
sudo chmod go-r /var/www/rica/php/SQL.php
```

3. Créer un utilisateur MariaDB "rica" avec le mot de passe de votre choix (`MOT_DE_PASSE` dans cet exemple).

4. Modifier le mot de passe dans `php/SQL.php` ligne 8.

5. Créer une base de données MariaDB nommée "rica" :

```bash
echo "
CREATE DATABASE rica;
GRANT ALL ON rica.* TO 'rica'@'localhost' IDENTIFIED BY 'MOT_DE_PASSE';
" | sudo mysql -u root
```

6. Importer le dernier dump SQL disponible :

```bash
sudo mysql -u root -D rica < "dumps/2022-05-04_rica.sql"
```

7. Créer un hôte virtuel Apache :

```bash
# Création d'un fichier définissant l'hote
echo "<VirtualHost *:80>
	ServerName rica.DOMAINE.fr
	DocumentRoot /var/www/rica
	AddDefaultCharset ISO-8859-15
</VirtualHost>" | sudo tee /etc/apache2/sites-available/rica.conf

# Ajout aux sites activés
sudo ln -s ../sites-available/rica.conf /etc/apache2/sites-enabled/rica.conf

# rechargement d'Apache
sudo service apache2 reload
```

8. Mettre en place un cron pour l'utilisateur `www-data` avec le contenu suivant :

```
0 */8 * * * cd /var/www/rica; php crons_a3R8fd5vH8sP.php
```

9. Il est également fortement recommandé d'activer HTTPS, par exemple en utilisant [certbot](https://certbot.eff.org/).

10. Exécutez le cron manuellement pour mettre à jour la base de données (et vraisemblablement déclencher un reboot de la partie dans RICA), en vous rendant sur `http(s)://rica.DOMAINE.fr/crons_a3R8fd5vH8sP.php`.

11. Il est recommandé de renommer le fichier `crons_a3R8fd5vH8sP.php` avec un autre nom aléatoire connu de l'administrateur seul afin d'éviter que les utilisateurs puissent lancer une mise à jour de la BDD. Si le fichier est renommé, ne pas oublier de mettre à jour le cron (étape 8).

