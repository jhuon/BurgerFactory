(function(){

    /**
     * Burger Factory Filters
     * @type {*|module}
     */
    var filters = angular.module('filters', []);

    filters.filter('dateToISO', function() {
        return function(input) {
            if(input) {
                return new Date(input).toISOString();
            }
            return "";
        };
    });
})();