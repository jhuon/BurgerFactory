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

class BurgerIngredientControllerProvider implements ControllerProviderInterface
{
    private $app;

    public function connect(Application $app)
    {
        $this->app = $app;

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // Fetch all BurgerIngredients
        $controllers->get('/', function (Request $request) use ($app) {
            $burger_id = $request->request->get('burger_id');
            $sql = "SELECT bi.id, bi.burger_id, bi.ingredient_id, i.name as ingredient, i.spicy_level, bi.weight
                    FROM BurgerIngredient bi
                    LEFT JOIN Ingredient i
                    ON i.id = bi.ingredient_id
                    WHERE bi.burger_id = ?";

            return $app->json($app['db']->fetchAll($sql, array((int) $burger_id)));
        });

        // Get BurgerIngredient by id
        $controllers->get('/{id}', function ($id) use ($app) {
            return $app->json($this->getBurgerIngredient($id));
        });

        // Fetch BurgerIngredient by Burger id
        $controllers->get('/byburger/{id}', function ($id) use ($app) {
            $sql = "SELECT bi.id, bi.ingredient_id, i.name, i.spicy_level, bi.weight
                    FROM BurgerIngredient bi
                    LEFT JOIN Ingredient i
                    ON i.id = bi.ingredient_id
                    WHERE bi.burger_id = ?";

            $burgeringredients = $app['db']->fetchAll($sql, array((int) $id));
            return $app->json($burgeringredients);
        });

        // Create BurgerIngredient
        $controllers->post('/', function (Request $request) use ($app) {
            $post = array(
                'burger_id' => $request->request->get('burger_id'),
                'ingredient_id'  => $request->request->get('ingredient_id'),
                'weight'  => $request->request->get('weight')
            );
            $app['db']->insert('BurgerIngredient', $post);
            return $app->json(array("id" => (int)$app['db']->lastInsertId()));
        });

        // Update BurgerIngredient from id
        $controllers->put('/{id}', function (Request $request, $id) use ($app) {
            $put = array(
                'burger_id' => $request->request->get('name'),
                'ingredient_id'  => $request->request->get('description'),
                'weight'  => $request->request->get('weight')
            );
            $response = $app['db']->update('BurgerIngredient', $put, array('id' => $id));
            return $app->json($response);
        });

        // Delete BurgerIngredient from id
        $controllers->delete('/{id}', function ($id) use ($app) {
            $app['db']->delete('BurgerIngredient', array('id' => $id));
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
    private function getBurgerIngredient($id)
    {
        $sql = "SELECT id, burger_id, ingredient_id, weight
                FROM BurgerIngredient
                WHERE id = ?";
        return $this->app['db']->fetchAssoc($sql, array((int) $id));
    }
}