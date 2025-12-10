<?php
require_once 'BaseDao.php';

class EquipmentDao extends BaseDao {
    public function __construct() {
        parent::__construct('equipment');
    }


    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare(
            "SELECT e.* FROM " . $this->table . " e
             JOIN user_equipments t ON e.id = t.id
             WHERE t.user_id = :user_id"
        );
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>