<?php
require_once '../dao/UserDao.php';
require_once 'BaseService.php';

class UserService extends BaseService {
    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }

    public function getByEmail($email) {
        if (empty($email)) {
            throw new InvalidArgumentException("Email cannot be null or empty.");
        } 
        return $this->dao->getByEmail($email);
    }

    public function getByTeam($team_id) {
        if (empty($team_id)) {
            throw new InvalidArgumentException("Team ID cannot be null or empty.");
        }
        return $this->dao->getByTeam($team_id);
    }
}
?>