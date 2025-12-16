<?php
require_once './services/EquipmentService.php';

/**
 * @OA\Get(
 *      path="/equipment/user/{user_id}",
 *      tags={"equipment"},
 *      summary="Get equipment by user ID",
 *      @OA\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the user"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of equipment for the given user"
 *      )
 * )
 */
Flight::route('GET /equipment/user/@user_id', function($user_id) {
    $equipmentService = new EquipmentService();
    try {
        $equipment = $equipmentService->getByUser($user_id);
        Flight::json($equipment);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/equipment",
 *      tags={"equipment"},
 *      summary="Get all equipment",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all equipment"
 *      )
 * )
 */
Flight::route('GET /equipment', function() {
    $equipmentService = new EquipmentService();
    $equipment = $equipmentService->getAll();
    Flight::json($equipment);
});

/**
 * @OA\Post(
 *      path="/equipment",
 *      tags={"equipment"},
 *      summary="Add new equipment",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "team_id"},
 *              @OA\Property(property="name", type="string", example="Helmet"),
 *              @OA\Property(property="team_id", type="integer", example=1),
 *              @OA\Property(property="description", type="string", example="Protective helmet")
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Equipment added successfully"
 *      )
 * )
 */
Flight::route('POST /equipment', function() {
    $data = Flight::request()->data->getData();
    $equipmentService = new EquipmentService();
    Flight::json(['id' => $equipmentService->addEquipment($data)]);
});

/**
 * @OA\Put(
 *      path="/equipment/{id}",
 *      tags={"equipment"},
 *      summary="Update existing equipment",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the equipment to update"
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "team_id"},
 *              @OA\Property(property="name", type="string", example="Updated Helmet"),
 *              @OA\Property(property="team_id", type="integer", example=1),
 *              @OA\Property(property="description", type="string", example="Updated description")
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Equipment updated successfully"
 *      )
 * )
 */
Flight::route('PUT /equipment/@id', function($id) {
    $data = Flight::request()->data->getData();
    $equipmentService = new EquipmentService();
    $equipmentService->updateEquipment($id, $data);
    Flight::json(['message' => 'Equipment updated successfully']);
});

/**
 * @OA\Delete(
 *      path="/equipment/{id}",
 *      tags={"equipment"},
 *      summary="Delete equipment by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the equipment to delete"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Equipment deleted successfully"
 *      )
 * )
 */
Flight::route('DELETE /equipment/@id', function($id) {
    $equipmentService = new EquipmentService();
    $equipmentService->deleteEquipment($id);
    Flight::json(['message' => 'Equipment deleted successfully']);
});
?>