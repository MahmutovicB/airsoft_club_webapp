<?php
require_once 'BaseDao.php';
class MessageDao extends BaseDao {
    public function __construct() {
        parent::__construct('messages');
    }

    public function getByStatus($status) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE status = :status ORDER BY created_at DESC");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecent($limit = 10) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteMessage($id) {
        $this->delete($id);
    }

    public function getBySenderName($name) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE name = :name ORDER BY created_at DESC");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>