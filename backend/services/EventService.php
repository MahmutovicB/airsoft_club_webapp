<?php
require_once './dao/EventDao.php';
require_once 'BaseService.php';

class EventService extends BaseService {
    public function __construct() {
        $dao = new EventDao();
        parent::__construct($dao);
    }

    public function getByStatus($status) {
        if (empty($status)) {
            throw new InvalidArgumentException("Status cannot be null or empty.");
        } 
        return $this->dao->getByStatus($status);
    }

    public function getUpcoming() {
        return $this->dao->getUpcoming();
    }

    public function addEvent($data) {
        if (empty($data['name']) || empty($data['date']) || empty($data['status'])) {
            throw new InvalidArgumentException("Name, date, and status are required.");
        }
        return $this->dao->addEvent($data);
    }
    
    public function updateEvent($id, $data) {
        if (empty($id) || empty($data['name']) || empty($data['date']) || empty($data['status'])) {
            throw new InvalidArgumentException("ID, name, date, and status are required.");
        }
        $this->dao->updateEvent($id, $data);
    }
    
    public function deleteEvent($id) {
        if (empty($id)) {
            throw new InvalidArgumentException("ID is required.");
        }
        $this->dao->deleteEvent($id);
    }
}
?>