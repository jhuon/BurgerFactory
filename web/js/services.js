(function() {

    var services = angular.module('services', ['ngResource']);

    services.factory('Burger', ['$resource',
        function($resource) {
            return $resource('api.php/burgers/:id', {id: '@_id'}, {'update': { method:'PUT' }}, {'stripTrailingSlashes': false});
    }]);

    services.factory('Ingredient', ['$resource',
        function($resource) {
            return $resource('api.php/ingredients/:id', {id: '@_id'}, {'update': { method:'PUT' }}, {'stripTrailingSlashes': false});
    }]);

    services.factory('BurgerIngredient', ['$resource',
        function($resource) {
            return $resource('api.php/burgeringredients/:id', {id: '@_id'},
                {
                    'update': { method:'PUT' },
                    'byburger': { method:'GET', params: {
                        id: '@_id'
                    }, isArray: true, url: 'api.php/burgeringredients/byburger/:id' }
                },
                {'stripTrailingSlashes': false});
        }]);

})();