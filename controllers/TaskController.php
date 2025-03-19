<?php
// controlleur pour les taches

require_once 'models/Database.php';
require_once 'models/Task.php';

class TaskController {
    private $taskModel;
    
    public function __construct() {
        // charger le modele task
        $this->taskModel = new Task();
    }
    
    // affiche la liste des taches
    public function index() {
        $tasks = $this->taskModel->getAllTasks();
        
        // charge la vue
        require_once 'views/tasks/index.php';
    }
    
    // traitement api ajout
    public function add() {
        header('Content-Type: application/json');
        
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
            
            // validations
            if(empty($data['title'])) {
                echo json_encode(['success' => false, 'message' => 'titre obligatoire']);
                return;
            }
            
            // ajouter
            if($this->taskModel->addTask($data)) {
                // reponse json ok
                echo json_encode([
                    'success' => true, 
                    'message' => 'tache ajoutée', 
                    'id' => $this->taskModel->getLastInsertId()
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'probleme ajout']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'methode invalide']);
        }
    }
    
    // traitement api delete
    public function delete() {
        header('Content-Type: application/json');
        
        // recup id
        $id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : 0);
        
        if(empty($id)) {
            echo json_encode(['success' => false, 'message' => 'id invalide']);
            return;
        }
        
        if($this->taskModel->deleteTask($id)) {
            echo json_encode(['success' => true, 'message' => 'tache supprimée']);
        } else {
            echo json_encode(['success' => false, 'message' => 'erreur suppression']);
        }
    }
}
?> 