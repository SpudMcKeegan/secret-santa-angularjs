secretSanta.controller('lookupCtrl', function($scope){
	$scope.testList = testList;
});

secretSanta.controller('createCtrl', ['$scope', function($scope){
	$scope.generateCode = function(){
		var code = Math.ceil(Math.random() * 9999);
		$scope.code = pad(code, 4);
		$scope.clicked = true;
	}

	$scope.createSecretSantaList = function(){
		newSecretSantaList = {
			name: $scope.name,
			creator: $scope.creator,
			code: $scope.code
		}

		console.log(newSecretSantaList);
		testList.push(newSecretSantaList);
	}
}]);

secretSanta.controller('signupCtrl', ['$scope', '$routeParams', function($scope, $routeParams){
	var entireList = testList;

	for (var j = 0; j < entireList.length; j++){
		if(entireList[j].id == $routeParams.id){
			$scope.listing = entireList[j];
			break;
		}
	}
}]);