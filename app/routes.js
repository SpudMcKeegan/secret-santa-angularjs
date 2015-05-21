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
		.when('/signup/:id',{
				controller: 'signupCtrl',
				templateUrl: 'app/secretSanta/partials/signup.html'	
			})
		.otherwise({redirectTo:'/home' });
}]);