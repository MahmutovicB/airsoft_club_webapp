<?php
require_once './services/EventUserService.php';

/**
 * @OA\Get(
 *      path="/event-users/event/{event_id}",
 *      tags={"event-users"},
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
Flight::route('GET /event-users/event/@event_id', function($event_id) {
    $eventUserService = new EventUserService();
    try {
        $users = $eventUserService->getByEvent($event_id);
        Flight::json($users);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/event-users/user/{user_id}",
 *      tags={"event-users"},
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
Flight::route('GET /event-users/user/@user_id', function($user_id) {
    $eventUserService = new EventUserService();
    try {
        $events = $eventUserService->getByUser($user_id);
        Flight::json($events);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/event-users/status/{status}",
 *      tags={"event-users"},
 *      summary="Get event-user relationships by status",
 *      @OA\Parameter(
 *          name="status",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Status of the event-user relationship (e.g., 'confirmed', 'pending')"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of event-user relationships with the given status"
 *      )
 * )
 */
Flight::route('GET /event-users/status/@status', function($status) {
    $eventUserService = new EventUserService();
    try {
        $relationships = $eventUserService->getByStatus($status);
        Flight::json($relationships);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});
?>