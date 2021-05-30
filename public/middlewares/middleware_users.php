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

$app->post('/iniciarsesion', function (Request $request, Response $response, $args) use($app) {
  
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
    $emailant  = $data['emailant'];
    $password = $data['password'];
    //$passwordant = $data['passwordant'];
    $dbhandler = new DBHandlerUsers();
    //$data= array('nombre' => $nombre,'email' => $email,'emaila' => $emailant,'pass' => $password,'id' => $id);
    //$response->getBody()->write(json_encode($data));
    $response->getBody()->write(json_encode($dbhandler->modifyUser($nombre, $email,$emailant,$password, $id)));
    
    return $response->withHeader('Content-Type', 'application/json');;
});

$app->post('/modificar/contrasena', function (Request $request, Response $response, $args) {
    $data =  $request->getParsedBody();
    $id = $data['id'];
    $email  = $data['email'];
    $password = $data['password'];
    $passwordant = $data['passwordant'];
    $dbhandler = new DBHandlerUsers();
    //$data= array('nombre' => $nombre,'email' => $email,'emaila' => $emailant,'pass' => $password,'id' => $id);
    //$response->getBody()->write(json_encode($data));
    $response->getBody()->write(json_encode($dbhandler->modifyPass($email,$passwordant,$password, $id)));
    
    return $response->withHeader('Content-Type', 'application/json');;
});
