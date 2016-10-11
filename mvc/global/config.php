<?php

// Identifiants pour la base de données
define('SQL_DSN',	'mysql:dbname=mvc;host=localhost');
define('SQL_USERNAME',	'root');
define('SQL_PASSWORD', '');

// Chemins à utiliser pour accéder aux vues/modeles/librairies
$module = empty($module) ? !empty($_GET['module']) ? $GET['module'] : 'index' : $module;
define('CHEMIN_VUE',	'modules/'.$module.'/vues/');
define('CHEMIN_MODELE',	'modeles/');
define('CHEMIN_LIB',	'libs/');