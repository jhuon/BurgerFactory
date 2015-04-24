<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use BurgerFactory\Controller;

require __DIR__ . '/app.php';

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../database/burgerfactory.db',
    ),
));

// Accepting a JSON Request Body (See http://silex.sensiolabs.org/doc/cookbook/json_request_body.html)
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

//controllers
$app->mount('/burgers', new Controller\BurgerControllerProvider());
$app->mount('/ingredients', new Controller\IngredientControllerProvider());
$app->mount('/burgeringredients', new Controller\BurgerIngredientControllerProvider());

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    switch ($code) {
        case 404:
            $message = 'No such Resource!';
            break;
        default:
            $message = $e->getMessage();
    }
    return $app->json(array('title' => 'API ' . $code,
                          'description' => $message), $code);
});

return $app;