<?php
/**
 * Created by PhpStorm.
 * User: jhuon
 * Date: 28/03/2015
 * Time: 16:03
 */

namespace BurgerFactory\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class IngredientControllerProvider implements ControllerProviderInterface
{
    private $app;

    public function connect(Application $app)
    {
        $this->app = $app;

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // Fetch all ingredients
        $controllers->get('/', function () use ($app) {
            $sql = "SELECT id, name, spicy_level FROM Ingredient";
            return $app->json($app['db']->fetchAll($sql));
        });

        // Get ingredient from id
        $controllers->get('/{id}', function ($id) use ($app) {
            return $app->json($this->getIngredient($id));
        });

        // Create ingredient
        $controllers->post('/', function (Request $request) use ($app) {
            $post = array(
                'name' => $request->request->get('name'),
                'spicy_level'  => $request->request->get('spicy_level'),
            );
            $app['db']->insert('Ingredient', $post);
            return $app->json(array("id" => (int)$app['db']->lastInsertId()));
        });

        // Update ingredient from id
        $controllers->put('/{id}', function (Request $request, $id) use ($app) {
            $put = array(
                'name' => $request->request->get('name'),
                'spicy_level'  => $request->request->get('spicy_level'),
            );
            $response = $app['db']->update('Ingredient', $put, array('id' => $id));
            return $app->json($response);
        });

        // Delete ingredient from id
        $controllers->delete('/{id}', function ($id) use ($app) {
            $app['db']->delete('Ingredient', array('id' => $id));
            return $app->json(1);
        });

        return $controllers;
    }

    /**
     * Get ingredient from id
     *
     * @param int $id
     * @return array
     */
    private function getIngredient($id)
    {
        $sql = "SELECT name, spicy_level FROM Ingredient WHERE id = ?";
        return $this->app['db']->fetchAssoc($sql, array((int) $id));
    }
}