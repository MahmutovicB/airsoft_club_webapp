<?php
require_once '../dao/EquipmentDao.php';
require_once 'BaseService.php';

class EquipmentService extends BaseService {
    public function __construct() {
        $dao = new EquipmentDao();
        parent::__construct($dao);
    }

    public function getByTeam($team_id) {
        if (empty($team_id)) {
            throw new InvalidArgumentException("Team ID cannot be null or empty.");
        } 
        return $this->dao->getByTeam($team_id);
    }
}
?>