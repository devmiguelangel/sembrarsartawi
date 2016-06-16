var header = function ($scope, $http) {
  $scope.getPolicies();

  $('input[name="warranty"]').click(function (e) {
    if (this.value == 0) {
      angular.element('#term').prop('value', 1).prop('readonly', true);
      angular.element('#type_term option[value="Y"]').prop('selected', true);
      angular.element('#payment_method option[value="PT"]').prop('selected', true);

      angular.element('#type_term option:not(:selected)').prop('disabled', true);
      angular.element('#payment_method option:not(:selected)').prop('disabled', true);
      
      angular.element('#number-de-container').hide();
    } else {
      angular.element('#term').prop('value', '').prop('readonly', false);
      angular.element('#type_term option:first').prop('selected', true);
      angular.element('#payment_method option:first').prop('selected', true);

      angular.element('#type_term option').prop('disabled', false);
      angular.element('#payment_method option').prop('disabled', false);
      
      angular.element('#number-de-container').show();
    }

    angular.element('#type_term').triggerHandler('change');
    angular.element('#payment_method').triggerHandler('change');
  });

  $('input[name="warranty"]:checked').trigger('click');

  /**
   * Request create
   * @param  {[type]} event [description]
   */
  $scope.requestCreate = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.href;

    $http.get(url, {})
      .then(function (response) {
          if (response.status == 200) {
            var data = response.data;

            $scope.formData.facultative_observation = data.facultative_observation;

            $scope.popup(data.payload);
          }
        }, function(response){
          console.log(response);
        }).finally(function () {
          $scope.easyLoading('body', '', false);
        });
  };

  /**
   * Request store
   * @param  {[type]} event [description]
   */
  $scope.requestStore = function (event) {
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
          $scope.success = { facultative: true };

          $scope.redirect(response.data.location);
        }
      }, function (response) {
        if (response.status == 422) {
          $scope.errors = response.data;
        } else if (response.status == 500) {
          console.log('Unauthorized action.');
        }
      }).finally(function () {
        $scope.easyLoading('#popup', '', false);
      });
  };


};

module.exports.header = header;