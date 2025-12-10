<?php
require_once './services/EventService.php';

/**
 * @OA\Get(
 *      path="/events/status/{status}",
 *      tags={"events"},
 *      summary="Get events by status",
 *      @OA\Parameter(
 *          name="status",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Status of the events (e.g., 'active', 'completed')"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of events with the given status"
 *      )
 * )
 */
Flight::route('GET /events/status/@status', function($status) {
    $eventService = new EventService();
    try {
        $events = $eventService->getByStatus($status);
        Flight::json($events);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/events/upcoming",
 *      tags={"events"},
 *      summary="Get upcoming events",
 *      @OA\Response(
 *           response=200,
 *           description="Array of upcoming events"
 *      )
 * )
 */
Flight::route('GET /events/upcoming', function() {
    $eventService = new EventService();
    Flight::json($eventService->getUpcoming());
});

/**
 * @OA\Post(
 *      path="/events",
 *      tags={"events"},
 *      summary="Create a new event",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "date", "status"},
 *              @OA\Property(property="name", type="string", example="Airsoft Tournament"),
 *              @OA\Property(property="date", type="string", format="date", example="2023-12-01"),
 *              @OA\Property(property="status", type="string", example="upcoming"),
 *              @OA\Property(property="description", type="string", example="An exciting airsoft event.")
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Event created successfully"
 *      )
 * )
 */
Flight::route('POST /events', function() {
    $data = Flight::request()->data->getData();
    $eventService = new EventService();
    Flight::json(['id' => $eventService->addEvent($data)]);
});

/**
 * @OA\Put(
 *      path="/events/{id}",
 *      tags={"events"},
 *      summary="Update an existing event",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the event to update"
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "date", "status"},
 *              @OA\Property(property="name", type="string", example="Updated Event Name"),
 *              @OA\Property(property="date", type="string", format="date", example="2023-12-15"),
 *              @OA\Property(property="status", type="string", example="active"),
 *              @OA\Property(property="description", type="string", example="Updated event description.")
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Event updated successfully"
 *      )
 * )
 */
Flight::route('PUT /events/@id', function($id) {
    $data = Flight::request()->data->getData();
    $eventService = new EventService();
    $eventService->updateEvent($id, $data);
    Flight::json(['message' => 'Event updated successfully']);
});

/**
 * @OA\Delete(
 *      path="/events/{id}",
 *      tags={"events"},
 *      summary="Delete an event by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the event to delete"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Event deleted successfully"
 *      )
 * )
 */
Flight::route('DELETE /events/@id', function($id) {
    $eventService = new EventService();
    $eventService->deleteEvent($id);
    Flight::json(['message' => 'Event deleted successfully']);
});
?>