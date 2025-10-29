<?php
require_once 'BaseDao.php';

class EquipmentDao extends BaseDao {
    public function __construct() {
        parent::__construct('equipment');
    }

    public function getByTeam($team_id) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE team_id = :team_id");
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>