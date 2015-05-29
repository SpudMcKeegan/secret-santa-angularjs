var secretSanta = angular.module('secretSanta', ['ngRoute', 'routes']);

function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}


function spliceArray(array, id){
	for(var i = 0; i < array.length; i++){
		if(array[i].id === id){
			var splice = i;
		}
	}

	array.splice(splice,1);

	return array;
}