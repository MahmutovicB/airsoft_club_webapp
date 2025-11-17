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
}

?>