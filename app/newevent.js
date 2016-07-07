app.controller("neweventCtrl", function($scope ,$rootScope, $routeParams, $location, $http, Data) {
	$scope.newevent = {};
	$scope.newevent = {name:'',description:'',contact_phone:'', contact_mail:'',venue:'',city:'',created_by:''};
	console.log($scope.newevent.name);
	$Scope.newEvent = function(event) {
		$console.log("function is called");
		Data.post('newevent', {
			event: event
		}).then(function (results) {
				Data.toast(results);
				if(results.status == "success") {	
					$location.path('dasboard');
	 }
      });		
   }
});
