<?php
require 'vendor/autoload.php'; //run autoloader

require_once __DIR__ . '/services/AdminService.php';
require_once __DIR__ . '/services/GalleryPhotoService.php';
require_once __DIR__ . '/services/EquipmentService.php';
require_once __DIR__ . '/services/EventService.php';
require_once __DIR__ . '/services/EventUserService.php';
require_once __DIR__ . '/services/MessageService.php';
require_once __DIR__ . '/services/UserService.php';

Flight::register('adminService', 'AdminService'); //register service
Flight::register('galleryPhotoService', 'GalleryPhotoService');
Flight::register('equipmentService', 'EquipmentService');
Flight::register('eventService', 'EventService');
Flight::register('eventUserService', 'EventUserService');
Flight::register('messageService', 'MessageService');
Flight::register('userService', 'UserService');


Flight::route('/', function(){  //define route and define function to handle request
   echo 'Selam Alejk!';
});

require_once __DIR__ . '/routes/AdminRoute.php';
require_once __DIR__ . '/routes/UserRoute.php'; 
require_once __DIR__ . '/routes/EquipmentRoute.php';
require_once __DIR__ . '/routes/EventRoute.php';
require_once __DIR__ . '/routes/EventUserRoute.php';
require_once __DIR__ . '/routes/GalleryRoute.php';
require_once __DIR__ . '/routes/MessageRoute.php';



Flight::start();  //start FlightPHP
?>

