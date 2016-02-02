var angular = require('angular');
var ngAnimate = require('angular-animate');
/*var $ = require('jquery');
global.jQuery = $;
var bootstrap = require('bootstrap');*/

var DetailController       = require('./components/de/DetailController');
var BeneficiaryController  = require('./components/de/BeneficiaryController');
var FacultativeController  = require('./components/de/FacultativeController');
var CancellationController = require('./components/de/CancellationController');

var app = angular.module('sibas', ['ngAnimate']);

app.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.headers
      .common['X-Requested-With'] = 'XMLHttpRequest';
}]);

app.run(['$rootScope', '$compile', '$window', '$timeout', function($rootScope, $compile, $window, $timeout){
  $rootScope.formData = {
    mother_last_name: ''
  };

  $rootScope.errors = {
  };

  $rootScope.success = {
  };

  $rootScope.mcData = {
  };

  $rootScope.dataOptions = [];
  $rootScope.currentOption = [];

  $rootScope.mcEnabled = false;

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

  $rootScope.csrf_token = function () {
    return angular.element('meta[name="csrf-token"]').attr('content');
  };

  $rootScope.compileData = function (payload) {
    return $compile(payload)($rootScope);
  }

  $rootScope.submitForm = function (id_form) {
    $timeout(function(){
      angular.element(id_form).submit();
    }, 0);
  };

  $rootScope.easyLoading = function (element, theme, show) {
    if (show) {
      $(element).loading({
        theme: theme,                  //light
        message: 'Por favor espere...'
      });
    }

    if (! show) {
      $(element).loading('stop');
    }
  };

}]);

app.controller('DetailDeController', ['$scope', '$http', DetailController.detailEdit]);

app.controller('BeneficiaryController', ['$scope', '$http', BeneficiaryController.beneficiary]);

app.controller('FacultativeController', ['$rootScope', '$scope', '$http', '$compile', FacultativeController.facultative]);

app.controller('CancellationController', ['$scope', '$http', CancellationController.cancellation]);