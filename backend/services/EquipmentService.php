<?php
require_once './dao/EquipmentDao.php';
require_once 'BaseService.php';

class EquipmentService extends BaseService {
    public function __construct() {
        $dao = new EquipmentDao();
        parent::__construct($dao);
    }

    public function getByUser($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            throw new InvalidArgumentException("Invalid user ID");
        }
        return $this->dao->getByUserId($user_id);
    }
}
?>