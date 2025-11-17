<?php
require 'vendor/autoload.php'; //run autoloader
require './routes/AirsoftClubRoutes.php';

Flight::route('/', function(){  //define route and define function to handle request
   echo 'Hello world!';
});

Flight::start();  //start FlightPHP
?>

