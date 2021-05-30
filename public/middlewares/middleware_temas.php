<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('./handlers/dbHandlerTemas.php');

//createtema
$app->post('/tema/{nombre}/{descripcion}', function (Request $request, Response $response, $args) {
   
    $nombre = $args['nombre'];
    $file  = $_FILES;
    $descripcion = $args['descripcion'];
    $autho = array($request->getHeader('Authorization')[0]);
   
   //$data= array('file name' => $_FILES['file']['name'].$nombre);
   
   //$response->getBody()->write(json_encode($data));
    $dbhandler = new dbHandlerTemas();
    $response->getBody()->write(json_encode($dbhandler->createTema($nombre,$descripcion,$file,$autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/temas', function (Request $request, Response $response, $args) 
{
   
   // $data= array('nombre' => "vicente", 'p' => 12345);
   //$response->getBody()->write(json_encode($data));
    //$data= array('nombre' => $nombre, 'age' => 40);
    $autho= array($request->getHeader("Authorization")[0]);
    //$data= array('nombre' => "vicente", 'p' => $autho[0]);
    //$response->getBody()->write(json_encode($data));
    $dbhandler = new DBHandlerTemas();
    $response->getBody()->write(json_encode($dbhandler->showTemas($autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/temas/front', function (Request $request, Response $response, $args) 
{
    
   // $data= array('nombre' => "vicente", 'p' => 12345);
   //$response->getBody()->write(json_encode($data));
    //$data= array('nombre' => $nombre, 'age' => 40);
    /**
     * ->withHeader('Access-Control-Allow-Origin', 'http:///FormuTecMatematicasWeb/public/v1')
     *               ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
     *               ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
     *   });
     */
    $dbhandler = new DBHandlerTemas();
    //$data= array('nombre' => "vicente", 'p' =>"1234");
    //$response->getBody()->write(json_encode($data));
    $response->getBody()->write(json_encode($dbhandler->showTemasFront()));
    return $response->withHeader('Content-Type', 'application/json');
});
                    

$app->delete('/tema/{id}', function (Request $request, Response $response, $args) {

    
    $id = $args['id'];
    
    $data =  $request->getParsedBody();
    $url = $data['url'];
  
    $autho= array($request->getHeader("Authorization")[0]);
    // $data= array('nombre' => $url, 'p' => 12345);
   //$response->getBody()->write(json_encode($data));
    //$response->getBody()->write(json_encode($data));
    //$dbhandler = new DBHandlerComentarios();
   //$response->getBody()->write(json_encode($autho));
    $dbhandler = new DBHandlerTemas();
    $response->getBody()->write(json_encode($dbhandler->deleteTema($id,$url,$autho[0])));
    //$response->getBody()->write();
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/tema/{id}/{nombre}/{nombreAnt}/{descripcion}', function (Request $request, Response $response, $args) {

    $id = $args['id'];
    $nombre = $args['nombre'];
    $nombreAnt = $args['nombreAnt'];
    $descripcion = $args['descripcion'];
    $file  = $_FILES;
    $autho = array($request->getHeader('Authorization')[0]);
    
    $dbhandler = new DBHandlerTemas();
    //if(isset($_FILES['file']))
    //$response->getBody()->write(json_encode($dbhandler->deleteTema($id,$url,$autho[0])));
    if(isset($_FILES['file']))
    {
        $response->getBody()->write(json_encode($dbhandler->putTema($id,$nombre,$nombreAnt,$descripcion,$file,$autho[0])));
    }
    else
    {
        $response->getBody()->write(json_encode($dbhandler->patchTema($id,$nombre,$descripcion,$autho[0])));
    }
   
    //$data= array('nombre' => $nombre);
    //$response->getBody()->write(json_encode($data));
    //$dbhandler = new dbHandlerCarros();
    //$response->getBody()->write(json_encode($dbhandler->editCar($id, $marca, $modelo, $color,$kilometraje,$anio,$precio,$tipo)));
    return $response->withHeader('Content-Type', 'application/json');
  });
  