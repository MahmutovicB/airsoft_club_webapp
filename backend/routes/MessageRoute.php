<?php
require_once './services/MessageService.php';

/**
 * @OA\Get(
 *      path="/messages",
 *      tags={"messages"},
 *      summary="Get all messages",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all messages"
 *      )
 * )
 */
Flight::route('GET /messages', function() {
    $messageService = new MessageService();
    Flight::json($messageService->getAll());
});



/**
 * @OA\Get(
 *      path="/messages/sender/{name}",
 *      tags={"messages"},
 *      summary="Get messages by sender name",
 *      @OA\Parameter(
 *          name="name",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Name of the sender"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of messages sent by the given sender"
 *      )
 * )
 */
Flight::route('GET /messages/sender/@name', function($name) {
    $messageService = new MessageService();
    try {
        $messages = $messageService->getBySenderName($name);
        Flight::json($messages);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Delete(
 *      path="/messages/{id}",
 *      tags={"messages"},
 *      summary="Delete a message by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the message to delete"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Message deleted successfully"
 *      )
 * )
 */
Flight::route('DELETE /messages/@id', function($id) {
    $messageService = new MessageService();
    try {
        $messageService->deleteMessage($id);
        Flight::json(['message' => 'Message deleted successfully']);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});
?>