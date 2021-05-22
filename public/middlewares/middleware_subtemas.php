<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('./handlers/dbHandlerSubtemas.php');

//createtema
$app->post('/subtema/{nombre}', function (Request $request, Response $response, $args) {
   
    $nombre = $args['nombre'];
    $pdf  = $_FILES;
    $autho = array($request->getHeader('Authorization')[0]);
   
   
    $dbhandler = new dbHandlerSubtemas();
    $response->getBody()->write(json_encode($dbhandler->createSubtema($nombre,$pdf,$autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/subtemas', function (Request $request, Response $response, $args) {
   
   
    $autho= array($request->getHeader("Authorization")[0]);
    $dbhandler = new dbHandlerSubtemas();
    $response->getBody()->write(json_encode($dbhandler->showSubtemas($autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/subtema/{id}', function (Request $request, Response $response, $args) {

    
    $id = $args['id'];
    
    $data =  $request->getParsedBody();
    $url = $data['url'];
  
    $autho= array($request->getHeader("Authorization")[0]);
  
    $dbhandler = new DBHandlerSubtemas();
    $response->getBody()->write(json_encode($dbhandler->deleteSubtema($id,$url,$autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/tema/{id}/{nombre}/{nombreAnt}', function (Request $request, Response $response, $args) {

    $id = $args['id'];
    $nombre = $args['nombre'];
    $nombreAnt = $args['nombreAnt'];
    $pdf  = $_FILES;
    $autho = array($request->getHeader('Authorization')[0]);
    
    $dbhandler = new dbHandlerSubtemas();
    if(isset($_FILES['file']))
    {
        $response->getBody()->write(json_encode($dbhandler->putSubtema($id,$nombre,$nombreAnt,$pdf,$autho[0])));
    }
    else
    {
        $response->getBody()->write(json_encode($dbhandler->patchSubtema($id,$nombre,$autho[0])));
    }
   
    //$data= array('nombre' => $nombre);
    //$response->getBody()->write(json_encode($data));
    //$dbhandler = new dbHandlerCarros();
    //$response->getBody()->write(json_encode($dbhandler->editCar($id, $marca, $modelo, $color,$kilometraje,$anio,$precio,$tipo)));
    return $response->withHeader('Content-Type', 'application/json');
  });
  