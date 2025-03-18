<?php
// fichier de config pour la bd et autres parametres

// parametres bd
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root'); 
define('DB_NAME', 'todo_app');

// config du site
define('BASE_URL', 'http://localhost/Examen');
define('SITE_NAME', 'Todo App');

// fonction pour debug
function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// fonction de redirection
function redirect($page = '') {
    if($page == '') {
        header('Location: ' . BASE_URL);
    } else {
        header('Location: ' . BASE_URL . '?' . $page);
    }
    exit();
}
?> 