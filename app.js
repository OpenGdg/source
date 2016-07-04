var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/events", {
        templateUrl : "views/dashboard.html",
        controller : "dashCtrl"
    })
    .when("/", {
        templateUrl : "views/login.html",
        controller : "loginCtrl"
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
});
