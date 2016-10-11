<?php

// Inclusion du fichier de configuration (qui définit des consantes)
include 'global/config.php';

// Désactivation des guillements magiques (Si version de php inf a 5)
ini_set('magic_quotes_runtime', 0);
set_magic_quotes_runtime(0);

if(1 == get_magic_quotes_gpc()){
	function remove_magic_quotes_pgc(&$value){
		$value = stripslashes($value);
	}
	array_walk_recursive($_GET, 'remove_magic_quotes_pgc');
	array_walk_recursive($_POST, 'remove_magic_quotes_pgc');
	array_walk_recursive($_COOKIE, 'remove_magic_quotes_pgc');
}

// Inclusion de Pdo2
include CHEMIN_LIB.'pdo2.php';