<?php
require_once '../dao/EventDao.php';
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
}
?>