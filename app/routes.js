var routes = angular.module('routes', ['ngRoute']);

routes.config(['$routeProvider', function ($routeProvider){
	$routeProvider
		.when('/home',
			{
				controller: 'lookupCtrl',
				templateUrl: 'app/secretSanta/partials/lookup.html'
			})
		.when('/create',
			{
				controller: 'createCtrl',
				templateUrl: 'app/secretSanta/partials/create.html'
			})
		.when('/join/:id',{
				controller: 'joinCtrl',
				templateUrl: 'app/secretSanta/partials/join.html'	
			})
		.when('/manage/',{
				controller: 'manageCtrl',
				templateUrl: 'app/secretSanta/partials/manage.html'
		})
		.otherwise({ redirectTo:'/home' });
}]);