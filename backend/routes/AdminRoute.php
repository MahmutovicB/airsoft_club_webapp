<?php
require_once './services/AdminService.php';

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
    Flight::json($adminService->getAllUsers());
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
 *      path="/admin/email/{email}",
 *      tags={"admins"},
 *      summary="Get admin by email",
 *      @OA\Parameter(
 *          name="email",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          description="Email of the admin"
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Admin with the given email"
 *      )
 * )
 */
Flight::route('GET /admin/email/@email', function($email) {
    $adminService = new AdminService();
    Flight::json($adminService->getByEmail($email));
});

/**
 * @OA\Post(
 *      path="/admin",
 *      tags={"admins"},
 *      summary="Add a new admin",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"username", "email", "password"},
 *              @OA\Property(property="username", type="string", description="Username of the admin"),
 *              @OA\Property(property="email", type="string", description="Email of the admin"),
 *              @OA\Property(property="password", type="string", description="Password of the admin")
 *          )
 *      ),
 *      @OA\Response(
 *           response=201,
 *           description="Admin successfully created"
 *      ),
 *      @OA\Response(
 *           response=400,
 *           description="Invalid input"
 *      )
 * )
 */
Flight::route('POST /admin', function() {
    $data = Flight::request()->data->getData();
    $adminService = new AdminService();
    $result = $adminService->addAdmin($data);
    Flight::json($result, 201);
});


?>