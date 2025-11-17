<?php
/**
 * @OA\Get(
 *      path="/admin",
 *      tags={"admins"},
 *      summary="Get all admins",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all admins in the database"
 *      )
 * )
 */
Flight::route('GET /admin', function() {
    $adminService = new AdminService();
    Flight::json($adminService->getAll());
});

/**
 * @OA\Get(
 *      path="/admin/username/{username}",
 *      tags={"admins"},
 *      summary="Get admin by username",
 *      @OA\Parameter(
 *          name="username",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Username of the admin"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Admin with the given username"
 *      )
 * )
 */
Flight::route('GET /admin/username/@username', function($username) {
    $adminService = new AdminService();
    Flight::json($adminService->getByUsername($username));
});

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
    Flight::json($galleryPhotoService->getByCategory($category));
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
 *      path="/equipment/team/{team_id}",
 *      tags={"equipment"},
 *      summary="Get equipment by team ID",
 *      @OA\Parameter(
 *          name="team_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the team"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of equipment for the given team"
 *      )
 * )
 */
Flight::route('GET /equipment/team/@team_id', function($team_id) {
    $equipmentService = new EquipmentService();
    try {
        Flight::json($equipmentService->getByTeam($team_id));
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/event/status/{status}",
 *      tags={"events"},
 *      summary="Get events by status",
 *      @OA\Parameter(
 *          name="status",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Status of the events"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of events with the given status"
 *      )
 * )
 */
Flight::route('GET /event/status/@status', function($status) {
    $eventService = new EventService();
    try {
        Flight::json($eventService->getByStatus($status));
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Get(
 *      path="/event/upcoming",
 *      tags={"events"},
 *      summary="Get upcoming events",
 *      @OA\Response(
 *           response=200,
 *           description="Array of upcoming events"
 *      )
 * )
 */
Flight::route('GET /event/upcoming', function() {
    $eventService = new EventService();
    Flight::json($eventService->getUpcoming());
});

/**
 * @OA\Get(
 *      path="/event/user/{user_id}",
 *      tags={"event_users"},
 *      summary="Get events by user ID",
 *      @OA\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the user"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of events for the given user"
 *      )
 * )
 */
Flight::route('GET /event/user/@user_id', function($user_id) {
    $eventUserService = new EventUserService();
    try {
        Flight::json($eventUserService->getByUser($user_id));
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Get(
 *      path="/event/event/{event_id}",
 *      tags={"event_users"},
 *      summary="Get users by event ID",
 *      @OA\Parameter(
 *          name="event_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the event"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of users for the given event"
 *      )
 * )
 */
Flight::route('GET /event/event/@event_id', function($event_id) {
    $eventUserService = new EventUserService();
    try {
        Flight::json($eventUserService->getByEvent($event_id));
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});
?>