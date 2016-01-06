var angular = require('angular');
/*var $ = require('jquery');
global.jQuery = $;
var bootstrap = require('bootstrap');*/

var app = angular.module('sibas', []);

app.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.headers
      .common['X-Requested-With'] = 'XMLHttpRequest';
}]);

app.controller('DetailDeController', ['$scope', '$compile', '$http', function($scope, $compile, $http){
  this.createBeneficiary = function (event) {
    event.preventDefault();

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          var payload = $compile(data.payload)($scope);

          $('#popup').find('.modal-body').html(payload);
          $('#popup').modal();
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      });
  };


}]);

app.controller('BeneficiaryController', ['$scope', '$http', '$window', function($scope, $http, $window){
  $scope.formData = {

  };

  $scope.errors = {

  };

  $scope.store = function (event) {
    event.preventDefault();

    var action = getActionAttribute(event);

    $http({
      method: 'POST',
      url: action,
      data: $.param($scope.formData),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).success(function (data, status, headers, config) {
        $scope.errors = {};

        $window.location.href = data.location;

      })
      .error(function (err, status, headers, config) {
        if (status == 422) {
          $scope.errors = err;
        }

        console.log(err);
      });
  }

}]);

function getActionAttribute (event) {
  return event.target.attributes.action.value;
}