<?php

include_once 'src/bootstrap.php';

define('ROOT_PATH', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('ENVIRONMENT', 'DEVELOPMENT');
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'blog');

switch(ENVIRONMENT)
{
	case 'DEVELOPMENT':
	   error_reporting(E_ALL);
	   ini_set('display_errors', 1);
	break;

	case 'PRODUCTION':
	   error_reporting(0); 
	break;
}

use app\data\Registry;

$registry = registry::getInstance();
$registry->set('conexao', new PDO('mysql:host='.HOST.';dbname='.DB.'', USERNAME, PASSWORD));
$PDO = registry::getInstance()->get('conexao');

if(isset($_GET['pg'])) {
	$pg = $_GET['pg'];
	if(file_exists("public/{$pg}.php")) {
		include 'public/includes/header.php';
		include "public/{$pg}.php";
		include 'public/includes/footer.php';
	} else {
		die('A página requisitada não existe!');
	}
}