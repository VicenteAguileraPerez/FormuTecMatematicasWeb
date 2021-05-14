<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

include_once("./public/handlers/dbHandlerUsers.php");
$app = AppFactory::create();

$app->setBasePath("/FormuTecMatematicasWeb/public/v1");

$app->get('/{name}', function (Request $request, Response $response, $args) {
    $nombre = $request->getAttribute('name');
    $response->getBody()->write("Hello " . $nombre);
    return $response;
});

$app->post('/registrarse', function (Request $request, Response $response, $args) {
    $data =  json_decode($request->getBody(), true);
    $nombre = $data['nombre'];
    $email  = $data['email'];
    $password = $data['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->createUser($nombre, $email, $password)));
    //$response->getBody()->write($data);
    //echo json_encode($nombre);
    //return $response;
    return $response->withHeader("Content-Type", "application/json");
});

$app->post('/iniciarsesion', function (Request $request, Response $response, $args) {
    $data =  json_decode($request->getBody(), true);
    $email  = $data['email'];
    $password = $data['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->iniciarSesion($email, $password)));
    //$response->getBody()->write($data);p
    //echo json_encode($nombre);
    return $response;
});

$app->put('/modificar/cliente', function (Request $request, Response $response, $args) {
    $data =  json_decode($request->getBody(), true);
    $id = $data['id'];
    $nombre = $data['nombre'];
    $email  = $data['email'];
    $password = $data['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->modifyUser($nombre, $email, $password, $id)));
    //$response->getBody()->write($data);
    //echo json_encode($nombre);
    return $response;
});
