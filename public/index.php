<?php

use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require('../vendor/autoload.php');

//$app = new Slim\App([]);
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath("/FormuTecMatematicasWeb/public/v1");
$app->addBodyParsingMiddleware();//para que el getBody no este null
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

include_once __DIR__ . '\\middlewares\\middleware_subtemas.php';
include_once __DIR__ . '\\middlewares\\middleware_users.php';
include_once __DIR__ . '\\middlewares\\middleware_comentarios.php';
include_once __DIR__ . '\\middlewares\\middleware_temas.php';

try {
  $app->run();
} catch (Exception $e) {
  // We display a error message
  die(json_encode(array("error" => true, "message" => "This action is not allowed" .__DIR__)));
}

/**
 *  <?php
 * include_once("./dbHandler.php");
 * $dbhandler= new DBHandler();
 * var_dump($dbhandler->createUser("vicente","vic@hotmail.com","12345678"));
 * ?>
 */