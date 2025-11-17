<?php
require_once 'BaseDao.php';

class GalleryPhotoDao extends BaseDao {
    public function __construct() {
        parent::__construct('gallery_photos');
    }

    public function getByCategory($category) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE category = :category ORDER BY uploaded_by DESC");
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecent($limit = 12) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " ORDER BY uploaded_by DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>