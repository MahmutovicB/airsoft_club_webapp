<?php
require_once 'BaseDao.php';

class EventDao extends BaseDao {
    public function __construct() {
        parent::__construct('events');
    }

    public function getByStatus($status) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE status = :status");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUpcoming() {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE event_date >= NOW() ORDER BY event_date ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addEvent($data) {
        $this->insert($data);
        return $data;
    }

    public function updateEvent($id, $data) {
        $this->update($id, $data);
    }

    public function deleteEvent($id) {
        $this->delete($id);
    }
}
?>