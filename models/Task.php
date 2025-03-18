<?php
// modele pour les taches

class Task {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // recup toutes les taches
    public function getAllTasks() {
        $this->db->query('SELECT * FROM tasks ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    // recup une tache par id
    public function getTaskById($id) {
        $this->db->query('SELECT * FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // ajouter une tache
    public function addTask($data) {
        // prep la requete
        $this->db->query('INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)');
        
        // bind les params
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        
        // executer
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // modif tache
    public function updateTask($data) {
        // prep la requete
        $this->db->query('UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id');
        
        // bind les params
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        
        // executer
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // suppr tache
    public function deleteTask($id) {
        // prep la requete
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        
        // bind les params
        $this->db->bind(':id', $id);
        
        // executer
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?> 