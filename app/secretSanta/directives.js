secretSanta.directive('navView', function(){
	return {
		restrict: 'E',
		link: function(s,e,a){
			console.log(s);
		},
		templateURL: 'partials/navView.html'
	};
});