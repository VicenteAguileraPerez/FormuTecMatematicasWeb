<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('./handlers/dbHandlerUsers.php');


$app->post('/registrarse', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();

    $nombre = $data['nombre'];
    $email  = $data['email'];
    $password = $data['password'];
   
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->createUser($nombre, $email, $password)));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/iniciarsesion', function (Request $request, Response $response, $args) {
    $data =  $request->getParsedBody();
    $email  = $data['email'];
    $password = $data['password'];
    
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->iniciarSesion($email, $password)));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/modificar/cliente', function (Request $request, Response $response, $args) {
    $data =  $request->getParsedBody();
    $id = $data['id'];
    $nombre = $data['nombre'];
    $email  = $data['email'];
    $password = $data['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->modifyUser($nombre, $email, $password, $id)));
    
    return $response->withHeader('Content-Type', 'application/json');;
});
