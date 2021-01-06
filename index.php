<?php

session_start();

// error_reporting(E_ALL); 
// ini_set('display_errors', 1); 

require_once 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
    case '/':
        $controller = new \App\Controller\Home();
 		$controller->run();
        break;
    case '/refresh-token':
		$controller = new \App\Controller\Cron();
		$controller->get_token();
        break;
    case '/create-task':
		$controller = new \App\Controller\Task();
		$controller->addTask();
        break;
    default:
       echo "Страница не найдена: 404";
}


