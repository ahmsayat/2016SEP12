var app = angular.module('app', []);

app.controller('controller', function($scope, $http) {
	$http.get('get_articles').success(function(res, status, headers, config) {
		$scope.articles = res;
	}).error(function(res, status, headers, config) {
		console.log(res);
	});
});


app.controller('controller_2', function($scope, $http) {
	$http.get('latest').success(function(res, status, headers, config) {
		$scope.articles = res;
	}).error(function(res, status, headers, config) {
		console.log(res);
	});
});
