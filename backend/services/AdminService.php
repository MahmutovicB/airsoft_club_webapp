<?php
require_once '../dao/AdminDao.php';
require_once 'BaseService.php';

class AdminService extends BaseService {
    public function __construct() {
        $dao = new AdminDao();
        parent::__construct($dao);
    }

    public function getByUsername($username) {
        if(empty($username)) {
            return $this->dao->getAll();
        } else {
            return $this->dao->getByUsername($username);
        }
    }

    public function getByEmail($email) {
        if(empty($email)) {
            return $this->dao->getAll();
        } else {
            return $this->dao->getByEmail($email); 
        }
    }

}
?>