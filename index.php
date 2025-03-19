<?php
// point d'entrée principal du site
// inclut les fichiers necessaires et demarre l'app

// config de base
require_once 'includes/config.php';

// charger les controlleurs
require_once 'controllers/TaskController.php';

// demarrage de la session
session_start();

// routage simple
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        $controller = new TaskController();
        $controller->index();
        break;
    case 'add':
        $controller = new TaskController();
        $controller->add();
        break;
    case 'delete':
        $controller = new TaskController();
        $controller->delete();
        break;
    default:
        $controller = new TaskController();
        $controller->index();
        break;
}
?> 