var person = {
	firstName: "John", 
	lastName: "McKeegan"
};

var teams = [
	{
		name: "CLG",
		rating: 8.5
	},{
		name: "C9",
		rating: 9.5
	},{
		name: "TIP",
		rating: 9.1
	},{
		name: "TSM",
		rating: 9.6
	},{
		name: "WFX",
		rating: 3.0
	},{
		name: "CST",
		rating: 3.0
	}
];

var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope){
	$scope.firstName = person.firstName;
	$scope.lastName = person.lastName;

	$scope.fullName = function(arg){
		return arg + ": " + $scope.firstName + " " + $scope.lastName;
	}
});

app.controller('teamCtl', function($scope){
	$scope.teams = teams;
});

app.controller('countCtl', function($scope){
	$scope.count = 0;
	
	$scope.counter = function(){
		if($scope.count > 5){alert('STAHP!');}

		return $scope.count = $scope.count + 1;
	}
});

app.controller('formCtrl', function($scope) {
    $scope.master = {firstName: "John", lastName: "Doe"};
    $scope.reset = function() {
        $scope.user = angular.copy($scope.master);
    };
    $scope.reset();
});