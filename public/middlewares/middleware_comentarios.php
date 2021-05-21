<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('./handlers/dbHandlerComentarios.php');





//createcomentario
$app->post('/crearcomentario', function (Request $request, Response $response, $args) {
    $data =  $request->getParsedBody();
    $nombre = $data['nombre'];
    $email  = $data['email'];
    $motivo = $data['motivo'];
    $mensaje = $data['mensaje'];
   /* $data= array('nombre' => "hola", 'p' => 12345);*/
   
   
    $dbhandler = new DBHandlerComentarios();
    $response->getBody()->write(json_encode($dbhandler->createComment($nombre, $email, $motivo,$mensaje)));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/vercomentarios', function (Request $request, Response $response, $args) {
   
   // $data= array('nombre' => "vicente", 'p' => 12345);
   //$response->getBody()->write(json_encode($data));
    //$data= array('nombre' => $nombre, 'age' => 40);
    $autho= array($request->getHeader("Authorization")[0]);
    $dbhandler = new DBHandlerComentarios();
    $response->getBody()->write(json_encode($dbhandler->showComments($autho[0])));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/eliminarcomentario/{id}', function (Request $request, Response $response, $args) {

    
    $id = $args['id'];
    
    //if()
  
    $autho= array($request->getHeader("Authorization")[0]);
    //$response->getBody()->write(json_encode($data));
    $dbhandler = new DBHandlerComentarios();
   //$response->getBody()->write(json_encode($autho));
    $response->getBody()->write(json_encode($dbhandler->deleteComment($id,$autho[0])));
    //$response->getBody()->write();
    return $response->withHeader('Content-Type', 'application/json');
});

/**
 * $data= array('nombre' => $email, 'p' => $password);
  *  $response->getBody()->write(json_encode($data));
  *if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
 */

 /**
  * $app->delete('/usuario/[{correo}]', function ($request, $response, $args) {
    *$sth = $this->db->prepare("DELETE FROM usuarios WHERE email=:correo");
  * $sth->bindParam("correo", $args['correo']);
  * $sth->execute();
  * $todos = $sth->fetchAll();
  * return $this->response->withJson($todos);
});
  */