<?php
require_once 'BaseDao.php';
class TeamDao extends BaseDao {
    public function __construct() {
        parent::__construct('teams');
    }
}

?>
