<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$config = [
	'settings' => [
		'displayErrorDetails' => true,
	]
];

$app = new \Slim\App($config);

/*
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
*/

require "../app/routes/noticias.php";

$app->run();