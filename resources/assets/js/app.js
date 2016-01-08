var angular = require('angular');
/*var $ = require('jquery');
global.jQuery = $;
var bootstrap = require('bootstrap');*/
//import detail from ".components/DetailController.js";

var DetailController = require('./components/de/DetailController');
var BeneficiaryController = require('./components/de/BeneficiaryController');

var app = angular.module('sibas', []);

app.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.headers
      .common['X-Requested-With'] = 'XMLHttpRequest';
}]);

app.run(['$rootScope', '$compile', '$window', '$timeout', function($rootScope, $compile, $window, $timeout){
  $rootScope.formData = {
  };

  $rootScope.errors = {
  };

  $rootScope.success = {
  };

  $rootScope.getActionAttribute = function (event) {
    return event.target.attributes.action.value;
  };

  $rootScope.popup = function (payload) {
    angular.element('#popup').find('.modal-body').html($compile(payload)($rootScope));
    angular.element('#popup').modal();
  };

  $rootScope.redirect = function (location) {
    $timeout(function(){
      $window.location.href = location;
    }, 1500);
  };

}]);

app.controller('DetailDeController', ['$scope', '$http', DetailController.detailEdit]);

app.controller('BeneficiaryController', ['$scope', '$http', BeneficiaryController.beneficiary]);