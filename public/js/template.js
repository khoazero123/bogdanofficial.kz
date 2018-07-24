jQuery(document).ready(function($) {

	$(".headroom").headroom({
		"tolerance": 20,
		"offset": 50,
		"classes": {
			"initial": "animated",
			"pinned": "slideDown",
			"unpinned": "slideUp"
		}
	});

   //  $(".phone-mask").mask("+7(999)-999-99-99");

});


var app = angular.module("Main", []);
app.controller("MainCntrl", function($scope, $http, $timeout, $compile){

});