<?php
// class database pour connecter a la bd

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    
    private $dbh;
    private $error;
    private $stmt;
    
    public function __construct() {
        // dsn = data source name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // options pdo
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        // creation de l'instance pdo
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    
    // prepare la requete
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    // bind les valeurs
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    // execute la requete
    public function execute() {
        try {
            return $this->stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    // recupere tous les enregistrements
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // recupere un seul enreg
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // compte les lignes
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
    // dernier id insere
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}
?> 