app.controller("neweventCtrl", function($scope ,$rootScope, $routeParams, $location, $http, Data) {
	$scope.newevent = {};
	//$scope.newevent = {name:'ajay',description:'',contact_phone:'', contact_mail:'',venue:'',city:'',created_by:''};
	//console.log($scope.newevent.name);
	$scope.newEvent = function(event) {
		console.log("function is called"+event.name);
		Data.post('newevent', {
			event: event
		}).then(function (results) {
				Data.toast(results);
						//			console.log("returning after success"+ results.message);

				if(results.status == "success") {	
					console.log("returning after success"+ results.message);
					results.uid=true;
					$location.path('/dasboard');
	 				}else{
	 					$location.path('dasboard');
	 				}
      }
      );	
   }
});
