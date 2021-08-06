<?php

require_once('./Controller/MovieController.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// This could be moved to a helper funciton as we can access $_GET from anywhere 
// Get if xml flag is set to try;
if (array_key_exists('xml', $_GET)) {
    if ($_GET['xml'] === 'true') {
        // Set it to global variable
        $GLOBALS['xml'] = true;
  }else{
    $GLOBALS['xml'] = false; 
  }
}

$request = $uri[4];
/* print_r($uri); */
// If first param is any of the following handle request in their controllers
switch ($request) {
    case 'users':
      echo('We are in the users endpoint');
        break;
    case 'movies':
      $movieController = new MovieController();
      $movieController->handleRequest();
      break;
 
    default:
        // Return default 404
        // TODO: Throw and error here
        echo("404");
        echo($request);
}
