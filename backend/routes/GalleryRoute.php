<?php
require_once './services/GalleryPhotoService.php';

/**
 * @OA\Get(
 *      path="/gallery/category/{category}",
 *      tags={"gallery"},
 *      summary="Get gallery photos by category",
 *      @OA\Parameter(
 *          name="category",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Category of the gallery photos"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of gallery photos in the given category"
 *      )
 * )
 */
Flight::route('GET /gallery/category/@category', function($category) {
    $galleryPhotoService = new GalleryPhotoService();
    try {
        $photos = $galleryPhotoService->getByCategory($category);
        Flight::json($photos);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/gallery/recent",
 *      tags={"gallery"},
 *      summary="Get recent gallery photos",
 *      @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="integer"),
 *          description="Limit the number of recent photos"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of recent gallery photos"
 *      )
 * )
 */
Flight::route('GET /gallery/recent', function() {
    $limit = Flight::request()->query->limit ?? 12; // Default limit is 12
    $galleryPhotoService = new GalleryPhotoService();
    Flight::json($galleryPhotoService->getRecent($limit));
});

/**
 * @OA\Get(
 *      path="/gallery/{gallery_id}",
 *      tags={"gallery"},
 *      summary="Get gallery photos by gallery ID",
 *      @OA\Parameter(
 *          name="gallery_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the gallery"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of gallery photos for the given gallery ID"
 *      )
 * )
 */
Flight::route('GET /gallery/@gallery_id', function($gallery_id) {
    $galleryPhotoService = new GalleryPhotoService();
    try {
        $photos = $galleryPhotoService->getByGallery($gallery_id);
        Flight::json($photos);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});
?>