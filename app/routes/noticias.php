<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Post;

$config = [
	'settings' => [
		'displayErrorDetails' => true,
	]
];

$app = new \Slim\App($config);

$app->get('/api/noticias', function (Request $request, Response $response) {
    $noticiasModel = new Post();

    $noticias = $noticiasModel->findAll();

    echo json_encode($noticias);
});

$app->get('/api/noticias/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute("id");

    $noticiasModel = new Post();
    $noticia = $noticiasModel->find($id);

    echo json_encode($noticia);
});

$app->post('/api/noticias', function(Request $request, Response $response){
	$data = $request->getParseBody();
	//
});

$app->delete('/api/noticias/delete/{id}', function(Request $request, Response $response){
	//$data = $request->getParseBody();
	$id = $request->getAttribute("id");

	$noticiasModel = new Post();
    $delete = $noticiasModel->delete($id);

    if($delete){
    	echo json_encode(['delete'=>'ok', 'id'=>$id]);
    }else{
    	echo json_encode(['delete'=>'fail', 'id'=>$id]);
    }
});