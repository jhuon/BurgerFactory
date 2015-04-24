(function() {

    /**
     * Burger Factory Routes
     * @type {*|module}
     */

    var app = angular.module('app', ['ngRoute', 'controllers', 'services', 'filters']);

    app.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                when('/', {
                    templateUrl: 'partials/homepage.html',
                    controller: 'HomepageCtrl'
                }).
                when('/burgers', {
                    templateUrl: 'partials/burger-list.html',
                    controller: 'BurgerListCtrl',
                    activetab: 'burgers'
                }).
                when('/burgers/:id', {
                    templateUrl: 'partials/burger-detail.html',
                    controller: 'BurgerDetailCtrl',
                    activetab: 'burgers'
                }).
                when('/creator', {
                    templateUrl: 'partials/burger-edit.html',
                    controller: 'BurgerEditCtrl',
                    activetab: 'burgers'
                }).
                when('/burgers/:id/edit', {
                    templateUrl: 'partials/burger-edit.html',
                    controller: 'BurgerEditCtrl',
                    activetab: 'burgers'
                }).
                when('/ingredients', {
                    templateUrl: 'partials/ingredient-list.html',
                    controller: 'IngredientListCtrl',
                    activetab: 'ingredients'
                }).
                when('/about', {
                    templateUrl: 'partials/about.html',
                    controller: 'AboutCtrl',
                    activetab: 'about'
                }).
                otherwise({
                    redirectTo: '/'
                });
        }]);

})();