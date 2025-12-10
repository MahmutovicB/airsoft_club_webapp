<?php
require_once './dao/GalleryPhotoDao.php';
require_once 'BaseService.php';

class GalleryPhotoService extends BaseService {
    public function __construct() {
        $dao = new GalleryPhotoDao();
        parent::__construct($dao);
    }

    public function getByGallery($gallery_id) {
        if (empty($gallery_id)) {
            throw new InvalidArgumentException("Gallery ID cannot be null or empty.");
        } 
        return $this->dao->getByGallery($gallery_id);
    }
}

?>