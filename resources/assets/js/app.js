var angular = require('angular');
var ngAnimate = require('angular-animate');
/*var $ = require('jquery');
global.jQuery = $;
var bootstrap = require('bootstrap');*/

var FacultativeController  = require('./components/FacultativeController');
var HeaderDeController     = require('./components/de/HeaderController');
var DetailDeController     = require('./components/de/DetailController');
var BeneficiaryController  = require('./components/de/BeneficiaryController');
var CancellationController = require('./components/de/CancellationController');
var HeaderViController     = require('./components/vi/HeaderController');
var HeaderAuController     = require('./components/au/HeaderController');
var DetailAuController     = require('./components/au/DetailController');

var ClientController       = require('./components/ClientController');

var app = angular.module('sibas', ['ngAnimate']);

app.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.headers
      .common['X-Requested-With'] = 'XMLHttpRequest';
}]);

app.run(['$rootScope', '$compile', '$window', '$timeout', function($rootScope, $compile, $window, $timeout){
  $rootScope.formData = {
    mother_last_name: '',
    emails: []
  };

  $rootScope.errors = {
  };

  $rootScope.success = {
  };

  $rootScope.mcData = {
  };

  $rootScope.dataOptions   = [];
  $rootScope.currentOption = [];
  $rootScope.data          = {};

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

app.controller('HeaderDeController', ['$rootScope', '$scope', '$http', HeaderDeController.header]);

app.controller('DetailDeController', ['$scope', '$http', DetailDeController.detailEdit]);

app.controller('BeneficiaryController', ['$scope', '$http', BeneficiaryController.beneficiary]);

app.controller('FacultativeController', ['$rootScope', '$scope', '$http', '$compile', '$filter', FacultativeController.facultative]);

app.controller('CancellationController', ['$scope', '$http', CancellationController.cancellation]);

app.controller('HeaderViController', ['$scope', '$http', '$compile', HeaderViController.header]);

app.controller('ClientController', ['$scope', ClientController.client]);

app.controller('HeaderAuController', ['$scope', '$http', HeaderAuController.header]);

app.controller('DetailAuController', ['$rootScope', '$scope', '$http', DetailAuController.detail]);