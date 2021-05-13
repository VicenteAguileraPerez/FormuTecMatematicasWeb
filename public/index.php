<?php

use Slim\Factory\AppFactory;

require('../vendor/autoload.php');

//$app = new Slim\App([]);
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->setBasePath("/FormuTecMatematicasWeb/public");

require './src/middleware_users.php';


try {
    $app->run();     
} catch (Exception $e) {    
  // We display a error message
  die( json_encode(array("status" => "failed", "message" => "This action is not allowed".$e))); 
}

/**
 *  <?php
 * include_once("./dbHandler.php");
 * $dbhandler= new DBHandler();
 * var_dump($dbhandler->createUser("vicente","vic@hotmail.com","12345678"));
 * ?>
 */

