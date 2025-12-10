<?php
require_once 'BaseDao.php'; 

class AdminDao extends BaseDao {
    public function __construct() {
        parent::__construct('admin');
    }

    public function getByUsername($username) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addAdmin($data) {
        // $columns = implode(", ", array_keys($data)); 
        // $placeholders = ":" . implode(", :", array_keys($data));
        // $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        // $stmt = $this->connection->prepare($sql);
        // return $stmt->execute($data);
        $this->insert($data);
        return $data; 
    }

}

?>