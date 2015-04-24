(function() {

    /**
     * Burger Factory Controllers
     *
     * @type {*|module}
     */
    var controllers = angular.module('controllers', []);

    /**
     * Homepage
     *
     * @param $scope
     * @param $http
     * @param Burger
     */
    controllers.controller('HomepageCtrl', ['$scope', '$http', 'Burger',
        function($scope, $http, Burger) {
            $scope.burgers = {};
            $http.get('/api.php/burgers/latest').success(function(data) {
                $scope.burgers = data;
            });
        }]);

    /**
     * List Burger
     *
     * @param $scope
     * @param Burger
     */
    controllers.controller('BurgerListCtrl', ['$scope', 'Burger',
        function($scope, Burger) {
            $scope.burgers = {};

            $scope.orderProps = [{id: 'id', name: 'ID'}, {id: 'name', name: 'Nom'}, {id: 'created_at', name: 'Date de création'}, {id: 'version', name: 'Version'}];
            $scope.orderProp = 'created_at';

            Burger.query(function(data) {
                $scope.burgers = data;
            });
        }]);

    /**
     * Burger Detail
     *
     * @param $scope
     * @param $routeParams
     * @param Burger
     */
    controllers.controller('BurgerDetailCtrl', ['$scope', '$routeParams', 'Burger', 'Ingredient', 'BurgerIngredient',
        function($scope, $routeParams, Burger, Ingredient, BurgerIngredient) {
            // Get burger
            $scope.burger = {};
            Burger.get({ id: $routeParams.id }, function(data) {
                $scope.burger = data;
            });

            // Get Burger Ingredients
            $scope.burgeringredients = {};
            BurgerIngredient.byburger({ id: $routeParams.id }, function(data) {
                $scope.burgeringredients = data;
            });

            // Get available ingredients
            $scope.ingredients = {};
            Ingredient.query(function(data) {
                $scope.ingredients = data;
            });

            // Set selected ingredient
            $scope.selectedIngredient = 0;

            // Add ingredient
            $scope.addIngredient = function() {
                // Create new BurgerIngredient
                var burgeringredient = new BurgerIngredient();
                burgeringredient.burger_id = $scope.burger.id;
                burgeringredient.ingredient_id = $scope.selectedIngredient;
                burgeringredient.weight = $( ".burger-ingredients tr:last").index() + 1;

                BurgerIngredient.save(burgeringredient, function(data1) {
                    var ingredient = {};
                    Ingredient.get({ id: burgeringredient.ingredient_id }, function(data2) {
                        ingredient = data2;
                        var rowBurgeringredient = {id: data1.id, name: ingredient.name, spicy_level: ingredient.spicy_level};
                        $scope.burgeringredients.push(rowBurgeringredient);
                    });
                });
            };

            // Remove Ingredient from ID
            $scope.removeIngredient = function(id) {
                BurgerIngredient.delete({id: id}, function() {
                    for( var i = 0; i < $scope.burgeringredients.length; i++ ) {
                        if( $scope.burgeringredients[i].id === id ) {
                            var index = i;
                            break;
                        }
                    }
                    $scope.burgeringredients.splice( index, 1 );
                });
            };
        }]);

    /**
     * Create and Update Burger
     *
     * @param $scope
     * @param $routeParams
     * @param $location
     * @param Burger
     */
    controllers.controller('BurgerEditCtrl', ['$scope', '$routeParams', '$location', 'Burger',
        function($scope, $routeParams, $location, Burger) {
            // Init Burger (create or update depending on route id)
            $scope.burger = {};
            if($routeParams.id) {
                Burger.get({ id: $routeParams.id }, function(data) {
                    $scope.burger = data;
                });
            } else {
                $scope.burger = new Burger();
            }

            // Save Burger (create or update depending on $scope.burger.id)
            $scope.save = function() {
                if($scope.burger.id) {
                    Burger.update({ id: $scope.burger.id }, $scope.burger, function() {
                        $location.path('/burgers/'+$scope.burger.id);
                    });
                } else {
                    Burger.save($scope.burger, function() {
                        $location.path('/burgers/'+$scope.burger.id);
                    });
                }
            };
        }]);

    /**
     * List Ingredients, Create and Update Ingredient
     *
     * @param $scope
     * @param Ingredient
     */
    controllers.controller('IngredientListCtrl', ['$scope', 'Ingredient',
        function($scope, Ingredient) {
            // Init variables
            $scope.ingredients = {};
            $scope.ingredient = {};

            // Order options
            $scope.orderProps = [{id: 'id', name: 'ID'}, {id: 'name', name: 'Nom'}, {id: 'spicy_level', name: "Niveau d'épice"}];
            $scope.orderProp = 'id';

            // Fetch all Ingredients
            Ingredient.query(function(data) {
                $scope.ingredients = data;
            });

            // Create or edit ingredient in a modal
            $scope.showModal = function(ingredient) {
                $scope.ingredient = ingredient ? ingredient : new Ingredient();
                $('#editIngredientModal').modal('show');
            };

            // Save ingredient (create or update depending on $scope.ingredient.id)
            $scope.save = function() {
                if($scope.ingredient.id) {
                    Ingredient.update({ id: $scope.ingredient.id }, $scope.ingredient, function() {
                        $('#editIngredientModal').modal('hide');
                    });
                } else {
                    Ingredient.save($scope.ingredient, function(data) {
                        $scope.ingredient.id = data.id;
                        $scope.ingredients.push($scope.ingredient);
                        $('#editIngredientModal').modal('hide');
                    });
                }
            };

            // Delete ingredient
            $scope.remove = function(id) {
                Ingredient.delete({id: id}, function() {
                    for( var i = 0; i < $scope.ingredients.length; i++ ) {
                        if( $scope.ingredients[i].id === id ) {
                            var index = i;
                            break;
                        }
                    }
                    $scope.ingredients.splice( index, 1 );
                });
            };

        }]);
})();