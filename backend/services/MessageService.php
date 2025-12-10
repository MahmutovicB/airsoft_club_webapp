<?php
require_once './dao/MessageDao.php';
require_once 'BaseService.php';

class MessageService extends BaseService {
    public function __construct() {
        $dao = new MessageDao();
        parent::__construct($dao);
    }

    public function getByStatus($status) {
        if (empty($status)) {
            throw new InvalidArgumentException("Status cannot be null or empty.");
        } 
        return $this->dao->getByStatus($status);
    }

    public function getRecent($limit = 10) {
        if (!is_int($limit) || $limit <= 0) {
            throw new InvalidArgumentException("Limit must be a positive integer.");
        }
        return $this->dao->getRecent($limit);
    }

    public function getAll() {
        return this->dao->getAll(); 
    }

    public function getBySenderName($name) {
        if (empty($name)) {
            throw new InvalidArgumentException("Sender name cannot be null or empty.");
        } 
        return $this->dao->getBySenderName($name);
    }

    public function deleteMessage($id) {
        if (empty($id)) {
            throw new InvalidArgumentException("ID is required.");
        }
        $this->dao->deleteMessage($id);
    }
}

?>