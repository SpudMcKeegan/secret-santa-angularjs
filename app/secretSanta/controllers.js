secretSanta.controller('lookupCtrl', function(getData, $scope){	
	params = {method: 'getAllLists'};

	success = function(data){
		$scope.lists = data;
	}

	fail = function (data){
		console.log("fail");
		console.log(data);
	}

	getData.doAjax(success, fail, params);
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

		getData.createList(success, fail, newSecretSantaList);
	}
});

secretSanta.controller('joinCtrl', ['getData', '$scope', '$routeParams', function(getData, $scope, $routeParams){
	$scope.show = true;
	$scope.joinForms = true;

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

	getData.doAjax(success, fail, params);

	$scope.checkCode = function(){
		console.log($scope.codeForm.$valid);
		if($scope.codeForm.$valid){
			params.method = 'checkCode';
			params.userCode = $scope.userCode;

			successCheck = function(data){
				if(data.success){			
					$scope.show = false;
					$scope.error = false;
				}else{
					$scope.show = true;
					$scope.error = true;
				}
			}

			failCheck = function(data){
				$scope.show = false;
				$scope.error = false;
				$scope.ajaxFail = true;	
			}

			getData.doAjax(successCheck, failCheck, params);
		}
	}


	$scope.joinList = function(){
		$scope.submitted = true;
		if($scope.userForm.$valid){
			params.method = 'joinList';
			params.userName = $scope.userName;
			params.userEmail = $scope.userEmail;

			successJoin = function(){
				console.log('success');
				$scope.joined = true;
				$scope.joinForms = false;
			}

			failJoin = function(){
				console.log('fail');
				$scope.ajaxFail = true;
			}

			getData.doAjax(successJoin, failJoin, params);
		}
	}
}]);

secretSanta.controller('manageCtrl', ['getData', '$scope', '$routeParams', function(getData, $scope, $routeParams){
	$scope.signin = true;

	
}]);