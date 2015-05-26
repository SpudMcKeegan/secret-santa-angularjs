secretSanta.controller('lookupCtrl', function(getData, $scope){	
	params = {method: 'getAllLists'};

	success = function(data){
		$scope.lists = data;
	}

	fail = function (data){
		console.log("fail");
		console.log(data);
	}

	getData.grabLists(success, fail, params);
});

secretSanta.controller('createCtrl', function(getData, $scope, $window){
	$scope.generateCode = function(){
		var code = Math.ceil(Math.random() * 9999);
		$scope.code = pad(code, 4);
		$scope.clicked = true;
	}

	$scope.createSecretSantaList = function(){
		newSecretSantaList = {
			method: 'createList',
			name: $scope.name,
			creator: $scope.creator,
			code: $scope.code
		}

		success = function(data){
			$window.location.href = '#/home';
		}

		fail = function(data){
			alert('something broke');
		}

		getData.createList(success, fail, newSecretSantaList)

		testList.push(newSecretSantaList);
	}
});

secretSanta.controller('signupCtrl', function(getData, $scope, $routeParams){
	params = {
		method: 'getSpecificList',
		id: $routeParams.id
	};

	success = function(data){
		$scope.listing = data;
	}

	fail = function (data){
		console.log("fail");
		console.log(data);
	}

	getData.grabLists(success, fail, params);

	$scope.joinListing = function(){
		
	}
});