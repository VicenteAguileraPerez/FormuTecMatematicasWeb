<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

include_once __DIR__ . "./dbHandlerUsers.php";

$app = AppFactory::create();

$app->setBasePath("/FormuTecMatematicasWeb/public/v1");
/*$app->get('/{name}', function (Request $request, Response $response, $args) {
    $nombre = $request->getAttribute('name');
    $response->getBody()->write("Hello " . $nombre);
    return $response;
});*/

$app->post('/registrarse', function (Request $request, Response $response, $args) use ($app) {
    $data =  json_decode($request->getBody(), true);
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $password = $_POST['password'];
    //$data= array('nombre' => $nombre, 'age' => 40);
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->createUser($nombre, $email, $password)));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/iniciarsesion', function (Request $request, Response $response, $args) {
    $data =  json_decode($request->getBody(), true);
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->iniciarSesion($email, $password)));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/modificar/cliente', function (Request $request, Response $response, $args) {
    $data =  json_decode($request->getBody(), true);
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $dbhandler = new DBHandlerUsers();
    $response->getBody()->write(json_encode($dbhandler->modifyUser($nombre, $email, $password, $id)));
    //$response->getBody()->write($data);
    //echo json_encode($nombre);
    return $response->withHeader('Content-Type', 'application/json');;
});
