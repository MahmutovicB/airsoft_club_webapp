<?php
require_once 'BaseDao.php';
class EventUserDao extends BaseDao {
    public function __construct() {
        parent::__construct('event_users');
    }

    public function getByEvent($event_id) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE event_id = :event_id");
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUser($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByStatus($status) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE status = :status");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>