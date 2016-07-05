var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider, $locationProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "views/login.html",
        controller : "loginCtrl"
    })
    .when("/events", {
        templateUrl : "views/dashboard.html",
        controller : "dashCtrl"
    })
    .when("/events/:id", {
    	templateUrl : "views/event.html",
    	controller : "eventCtrl"
    })
    .when("/profile", {
        templateUrl : "views/profile.html",
        controller : "profileCtrl"
    })
    .when("/signup", {
    	templateUrl : "views/signup.html",
    	controller : "signupCtrl"
    })
    .when("/newevent", {
    	templateUrl : "views/newevent.html",
    	controller : "neweventCtrl"
    });
   // $locationProvider.html5Mode(true);
});
