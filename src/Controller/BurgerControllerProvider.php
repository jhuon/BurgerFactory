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

class BurgerControllerProvider implements ControllerProviderInterface
{
    private $app;

    public function connect(Application $app)
    {
        $this->app = $app;

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // Fetch all burgers
        $controllers->get('/', function () use ($app) {
            $sql = "SELECT id, name, image, version, description, created_at
                    FROM Burger
                    ORDER BY datetime(created_at) DESC";

            $burgers = $app['db']->fetchAll($sql);
            return $app->json($burgers);
        });

        // Fetch latest burgers
        $controllers->get('/latest', function () use ($app) {
            $sql = "SELECT id, name, image, version, description, created_at
                    FROM Burger
                    ORDER BY datetime(created_at) DESC LIMIT 5";

            $burgers = $app['db']->fetchAll($sql);
            return $app->json($burgers);
        });

        // Get burger from id
        $controllers->get('/{id}', function ($id) use ($app) {
            return $app->json($this->getBurger($id));
        });

        // Create burger
        $controllers->post('/', function (Request $request) use ($app) {
            $post = array(
                'name' => $request->request->get('name'),
                'description'  => $request->request->get('description'),
                'created_at' => date("Y-m-d H:i:s")
            );
            $app['db']->insert('Burger', $post);
            return $app->json(array("id" => (int)$app['db']->lastInsertId()));
        });

        // Update burger from id
        $controllers->put('/{id}', function (Request $request, $id) use ($app) {
            $burger = $this->getBurger($id);
            $version = (int)$burger['version'];
            $version++;
            $put = array(
                'name' => $request->request->get('name'),
                'description'  => $request->request->get('description'),
                'version' => $version
            );
            $response = $app['db']->update('Burger', $put, array('id' => $id));
            return $app->json($response);
        });

        // Delete burger from id
        $controllers->delete('/{id}', function ($id) use ($app) {
            $app['db']->delete('Burger', array('id' => $id));
            return $app->json(1);
        });

        return $controllers;
    }

    /**
     * Get burger from id
     *
     * @param int $id
     * @return array $burger
     */
    private function getBurger($id)
    {
        $sql = "SELECT b.id, b.name, b.image, b.version, b.description, b.created_at
                FROM Burger b
                WHERE b.id = ?";

        $burger = $this->app['db']->fetchAssoc($sql, array((int) $id));

        $sql = "SELECT bi.id, i.name, i.spicy_level, bi.weight
                FROM Ingredient i
                LEFT JOIN BurgerIngredient bi
                ON bi.ingredient_id = i.id
                WHERE bi.burger_id = ?";

        $burger['ingredients'] = $this->app['db']->fetchAll($sql, array((int) $id));

        return $burger;
    }
}