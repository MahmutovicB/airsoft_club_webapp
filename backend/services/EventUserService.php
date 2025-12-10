<?php
require_once './dao/EventUserDao.php';
require_once 'BaseService.php';

class EventUserService extends BaseService {
    public function __construct() {
        $dao = new EventUserDao();
        parent::__construct($dao);
    }

    public function getByEvent($event_id) {
        if (empty($event_id)) {
            throw new InvalidArgumentException("Event ID cannot be null or empty.");
        } 
        return $this->dao->getByEvent($event_id);
    }

    public function getByUser($user_id) {
        if (empty($user_id)) {
            throw new InvalidArgumentException("User ID cannot be null or empty.");
        } 
        return $this->dao->getByUser($user_id);
    }
}
?>