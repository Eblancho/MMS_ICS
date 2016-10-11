<?php

// Initialisation
include 'global/init.php';

// Début de la temporisation de sortie
// Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
// Evite les proxy bloquant et surtout rend le traitement de donnée plus rapide en cas de connexion lente, evite aussi la surcharge serveur
ob_start();

// Si un module est specifié, on regarde s'il existe
if(!empty($_GET['module'])){
	$module = dirname(__FILE__).'/modules/'.$_GET['module'].'/';

	// Si l'action est specifiée, on l'utilise, sinon, on tente une action par défaut
	// Condition spéciale, on pourrait traduire par
	/*
		if(!empty($_GET['action'])){
			$action = $_GET['action'].php;
		}
		else
			$action = index.php;
	*/
	// Le "?" remplace le if et le ":" remplace le else
	// ça permet d'avoir un code relativement plus propre et surtout plus court
	$action = (!empty($_GET['action'])) ? $_GET['action'].'php' : 'index.php';

	// Si l'action existe, on l'exécute
	if (is_file($module.$action)){
		
		include $module.$action;
	
	// Sinon, on affiche la page d'accueil !
	} else {

		include 'global/accueil.php';
	}

// Module non spécifié ou invalide ? On affiche la page d'accueil !
} else {

	include 'global/accueil.php';
}

// Fin de la tamporisation de sortie
// Lit le contenu courant du tampon de sortie puis l'efface.
$contenu = ob_get_clean();

// Début du code HTML
include 'global/header.php';

echo $contenu;

// Fin du code HTML
include 'global/footer.php';