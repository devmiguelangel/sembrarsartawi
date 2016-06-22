var detail = function ($rootScope, $scope, $http) {

  /**
   * Vehicle edit issuance form
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.editIssuance = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.attributes.href.value;
    
    $http.get(url, {})
      .then(function (response) {
          if (response.status == 200) {
            var data = response.data;

            $rootScope.amount_max    = data.amount_max;
            $rootScope.exchange_rate = data.exchange_rate;
            $rootScope.currency      = data.currency;
            $scope.property          = false;

            $scope.formData.matter_insured     = data.detail.matter_insured;
            $scope.formData.matter_description = data.detail.matter_description;
            $scope.formData.number             = data.detail.number;
            $scope.formData.property_use       = data.detail.use;
            $scope.formData.city               = data.detail.city;
            $scope.formData.zone               = data.detail.zone;
            $scope.formData.locality           = data.detail.locality;
            $scope.formData.address            = data.detail.address;
            $scope.formData.insured_value      = data.detail.insured_value;

            $scope.popup(data.payload);
          }
        }, function(response){
          console.log(response);
        }).finally(function () {
          $scope.easyLoading('body', '', false);
        });
  };

  $scope.$watch('formData.matter_insured', function(value, oldValue, scope) {
    var label = angular.element('#insured_value_label');

    if (value == 'PR') {
      $scope.property = true;
      label.text('Valor de la Construcción: ');
      
      angular.element('#property_use option[value="OT"]').hide();
      angular.element('#property_use option[value!="OT"]').show();
    } else {
      $scope.property = false;
      label.text('Valor Asegurado: ');

      angular.element('#property_use option[value="OT"]').show();
      angular.element('#property_use option[value!="OT"]').hide();
    }

    angular.element('#property_use option[value=""]').show();
  });

  /**
   * Vehicle update issuance
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.updateIssuance = function (event) {
    event.preventDefault();

    $scope.easyLoading('#popup', 'dark', true);

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    var data = $.param($scope.formData);

    $http.put(action, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': CSRF_TOKEN
      }
    })
      .then(function (response) {
        $scope.errors = {};

        if (response.status == 200) {
          messageAction('succes', 'El Riesgo asegurado fue actualizado correctamente.');

          $scope.redirect(response.data.location);
        }
      }, function (response) {
        if (response.status == 422) {
          $scope.errors = response.data;
        } else if (response.status == 500) {
          console.log('Unauthorized action.');
        } else if (response.status == 428){
          $scope.errors = {};
          
          messageAction('error', response.data.reason);
        }
      }).finally(function () {
        $scope.easyLoading('#popup', '', false);
      });
  };

};

module.exports.detail = detail;