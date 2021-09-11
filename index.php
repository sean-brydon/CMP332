<?php

use DB\DatabaseConnector;
require __DIR__ . '/vendor/autoload.php';
require_once('./Controller/MovieController.php');
require_once('./Controller/AuthController.php');
require_once('./DB.php');


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$db = new DatabaseConnector();
$dbConnection = $db->getConnection();

// This could be moved to a helper funciton as we can access $_GET from anywhere 
// Get if xml flag is set to try;
if (array_key_exists('xml', $_GET)) {
  if ($_GET['xml'] === 'true') {
    // Set it to global variable
    $GLOBALS['xml'] = true;
  } else {
    $GLOBALS['xml'] = false;
  }
}


// If first param is any of the following handle request in their controllers
if (isset($uri[2])) {
  $request = $uri[2];
  switch ($request) {
    case 'movies':
      $movieController = new MovieController($dbConnection);
      $movieController->handleRequest();
      break;
    case 'auth':
      // Post to login and Post to register
      if(!isset($uri[3])) ResponseController::ErrorResponse("This route does not exist on this server. Please user Movies or Users");
      $authController = new AuthController($dbConnection);
      switch($uri[3]){
        case 'login':
          $authController->login();
          break;
        default:
         break;
      }
      break;
    default:
      ResponseController::ErrorResponse("This route does not exist on this server.");
  }
}else{
  ResponseController::ErrorResponse("This route does not exist on this server.");
}

