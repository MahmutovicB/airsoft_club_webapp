<?php
require 'vendor/autoload.php'; //run autoloader

require_once __DIR__ . '/services/AdminService.php';
require_once __DIR__ . '/services/GalleryPhotoService.php';
require_once __DIR__ . '/services/EquipmentService.php';
require_once __DIR__ . '/services/EventService.php';
require_once __DIR__ . '/services/EventUserService.php';
require_once __DIR__ . '/services/MessageService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::register('adminService', 'AdminService'); 
Flight::register('galleryPhotoService', 'GalleryPhotoService');
Flight::register('equipmentService', 'EquipmentService');
Flight::register('eventService', 'EventService');
Flight::register('eventUserService', 'EventUserService');
Flight::register('messageService', 'MessageService');
Flight::register('userService', 'UserService');
Flight::register('authService', 'AuthService');
Flight::register('authMiddleware', 'AuthMiddleware');


Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(!$token)
               Flight::halt(401, "Missing authentication header");$


           $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

           Flight::set('user', $decoded_token->user);
           Flight::set('jwt_token', $token);
           return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});




require_once __DIR__ . '/routes/AdminRoute.php';
require_once __DIR__ . '/routes/UserRoute.php'; 
require_once __DIR__ . '/routes/EquipmentRoute.php';
require_once __DIR__ . '/routes/EventRoute.php';
require_once __DIR__ . '/routes/EventUserRoute.php';
require_once __DIR__ . '/routes/GalleryRoute.php';
require_once __DIR__ . '/routes/MessageRoute.php';
require_once __DIR__ . '/routes/AuthRoutes.php';



Flight::start();  //start FlightPHP
?>

