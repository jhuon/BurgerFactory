Burger Factory est une application fictive réalisée pour Aquafadas.

Réalisé par Julien Huon
10 rue Saint-Claude
34000 Montpellier
06 88 58 51 19
julien.huon@gmail.com
www.julienhuon.com

Front-end
====================

Le front-end utilise les outils et technologies suivants :

* Les langages HTML5, CSS3, JavaScript
* Bootstrap, framework CSS
* AngularJS, framework JavaScript
* Bower, gestionnaire de paquet
* LESS, preprocesseur CSS

Back-end
====================

Le back-end utilise les outils et technologies suivants :

* Les languages PHP, JSON et SQL
* Une base SQLite pour stocker les données
* le micro-framework Silex
* Doctrine DBAL pour accéder aux données

Structure de l'application
====================

* /database : contient la base SQLite, ainsi que le schema SQL et quelques fixtures
* /src : contient le code de l'API
* /vendor : dépendences pour le back-end
* /web/components : dependences pour le front-end
* /web/css : feuille de styles, fichier LESS
* /web/images : images de burger utilisées
* /web/js : le code JavaScript de l'application
* /web/partials : les fichiers HTML utilisé comme vues
* /web/api.php : le point d'accès à l'API
* /web/index.html : le point d'accès au front-end

API
====================

Ressources disponibles :

* [GET, POST] /api.php/burgers/
* [UPDATE, DELETE] /api.php/burgers/:id
* [GET, POST] /api.php/ingredients/
* [UPDATE, DELETE] /api.php/ingredients/:id
* [GET, POST] /api.php/burgeringredients/
* [UPDATE, DELETE] /api.php/burgeringredients/:id
* [GET] /api.php/burgeringredients/byburger/:id

Copyright
====================

Les images utilisées sont © McDonald's France