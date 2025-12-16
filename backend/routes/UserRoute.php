<?php
require_once './services/UserService.php';

/**
 * @OA\Get(
 *      path="/user/email/{email}",
 *      tags={"users"},
 *      summary="Get user by email",
 *      @OA\Parameter(
 *          name="email",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Email of the user"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="User with the given email"
 *      )
 * )
 */
Flight::route('GET /user/email/@email', function($email) {
    $userService = new UserService();
    try {
        $user = $userService->getByEmail($email);
        Flight::json($user);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Get(
 *      path="/user/team/{team_id}",
 *      tags={"users"},
 *      summary="Get users by team ID",
 *      @OA\Parameter(
 *          name="team_id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the team"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Array of users in the given team"
 *      )
 * )
 */
Flight::route('GET /user/team/@team_id', function($team_id) {
    $userService = new UserService();
    try {
        $users = $userService->getByTeam($team_id);
        Flight::json($users);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Post(
 *      path="/user",
 *      tags={"users"},
 *      summary="Add a new user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="email", type="string"),
 *              @OA\Property(property="team_id", type="integer")
 *          )
 *      ),
 *      @OA\Response(
 *           response=201,
 *           description="User created successfully"
 *      )
 * )
 */
Flight::route('POST /user', function() {
    $userService = new UserService();
    $data = Flight::request()->data->getData();
    try {
        $user = $userService->addUser($data);
        Flight::json($user, 201); // Return 201 Created
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Put(
 *      path="/user/{id}",
 *      tags={"users"},
 *      summary="Update an existing user",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the user to update"
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="email", type="string"),
 *              @OA\Property(property="team_id", type="integer")
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="User updated successfully"
 *      )
 * )
 */
Flight::route('PUT /user/@id', function($id) {
    $userService = new UserService();
    $data = Flight::request()->data->getData();
    try {
        $user = $userService->updateUser($id, $data);
        Flight::json($user);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});

/**
 * @OA\Delete(
 *      path="/user/{id}",
 *      tags={"users"},
 *      summary="Delete a user",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          description="ID of the user to delete"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="User deleted successfully"
 *      )
 * )
 */
Flight::route('DELETE /user/@id', function($id) {
    $userService = new UserService();
    try {
        $userService->deleteUser($id);
        Flight::json(['message' => 'User deleted successfully']);
    } catch (InvalidArgumentException $e) {
        Flight::json(['error' => $e->getMessage()], 400); // Return 400 Bad Request for invalid input
    }
});


?>