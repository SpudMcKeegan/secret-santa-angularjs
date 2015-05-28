secretSanta.factory('getData', ['$http', function($http){
	return {
		doAjax: function(success, fail, params){
			$http({
					url: 'app/data/dataPackMule.php',
					method: 'get',
					params: params
				})
				.success(success)
				.error(fail);
		},
	}
}]);