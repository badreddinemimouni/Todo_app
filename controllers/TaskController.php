<?php
// controlleur pour les taches

require_once 'models/Database.php';
require_once 'models/Task.php';

class TaskController {
    private $taskModel;
    
    public function __construct() {
        $this->taskModel = new Task();
    }
    
    // affiche la liste des taches
    public function index() {
        $tasks = $this->taskModel->getAllTasks();
        
        // charge la vue
        require_once 'views/tasks/index.php';
    }
    
    // affiche form ajout
    public function add() {
        // si form soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // nettoyage donnees
            $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
            $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
            $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : 'non terminé';
            
            // init data
            $data = [
                'title' => $title,
                'description' => $description,
                'status' => $status
            ];
            
            // valide
            if(empty($data['title'])) {
                $data['title_err'] = 'titre obligatoire';
            }
            
            // check erreurs
            if(empty($data['title_err'])) {
                // ajouter
                if($this->taskModel->addTask($data)) {
                    // msg ok
                    $_SESSION['success_msg'] = 'tache ajoutée';
                    redirect('');
                } else {
                    die('probleme');
                }
            } else {
                // charge vue avec erreurs
                require_once 'views/tasks/add.php';
            }
        } else {
            // init data form vide
            $data = [
                'title' => '',
                'description' => '',
                'status' => 'non terminé'
            ];
            
            // charge la vue
            require_once 'views/tasks/add.php';
        }
    }
    
    // modif tache
    public function edit() {
        // recup id depuis l'URL ou depuis le champ caché
        $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['task_id']) ? $_POST['task_id'] : die('erreur id'));
        
        // si form soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // nettoyage donnees
            $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
            $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
            $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : 'non terminé';
            
            // init data
            $data = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'status' => $status
            ];
            
            // valide
            if(empty($data['title'])) {
                $data['title_err'] = 'titre obligatoire';
            }
            
            // check erreurs
            if(empty($data['title_err'])) {
                // modif
                if($this->taskModel->updateTask($data)) {
                    // msg ok
                    $_SESSION['success_msg'] = 'tache modifiée';
                    redirect('');
                } else {
                    die('probleme');
                }
            } else {
                // charge vue avec erreurs
                require_once 'views/tasks/edit.php';
            }
        } else {
            // recup tache existante
            $task = $this->taskModel->getTaskById($id);
            
            // init data form avec tache
            $data = [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status
            ];
            
            // charge la vue
            require_once 'views/tasks/edit.php';
        }
    }
    
    // suppr tache
    public function delete() {
        // recup id
        $id = isset($_GET['id']) ? $_GET['id'] : die('erreur id');
        
        if($this->taskModel->deleteTask($id)) {
            // msg ok
            $_SESSION['success_msg'] = 'tache supprimée';
            redirect('');
        } else {
            die('probleme');
        }
    }
}
?> 