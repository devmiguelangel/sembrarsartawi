var detail = function ($rootScope, $scope, $http) {
  /**
   * Vehicle create form
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.create = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.attributes['data-url'].value;

    $http.get(url, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $rootScope.data.types      = data.types;
          $rootScope.data.makes      = data.makes;
          $rootScope.data.categories = data.categories;

          $scope.formData.vehicle_type  = null;

          /*if ($rootScope.data.types.hasOwnProperty(0)) {
            $scope.formData.vehicle_type  = $rootScope.data.types[0];
          }*/

          $scope.formData.category      = null;
          $scope.formData.vehicle_make  = null;
          $scope.formData.vehicle_model = null;
          $scope.formData.year          = '';
          $scope.formData.license_plate = '';
          $scope.formData.use           = '';
          $scope.formData.mileage       = '';
          $scope.formData.insured_value = '';

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /**
   * Vehicle store
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.store = function (event) {
    event.preventDefault();

    $scope.easyLoading('#popup', 'dark', true);

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    $http({
      method: 'POST',
      url: action,
      data: $.param($scope.formData),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': CSRF_TOKEN
      }
    }).success(function (data, status, headers, config) {
        $scope.errors = {};

        if (status == 200) {
          $scope.success = { vehicle: true };

          $scope.redirect(data.location);
        }
      })
      .error(function (err, status, headers, config) {
        if (status == 422) {
          $scope.errors = err;
        } else if (status == 500) {
          console.log('Unauthorized action.');
        }

        // console.log(err);
      }).finally(function () {
        $scope.easyLoading('#popup', '', false);
      });

  };

  $scope.$watch('formData.vehicle_type', function(value, oldValue, scope) {
    if (value != null) {
      $scope.formData.category = value.category;
      $('#category option:not(:selected)').prop('disabled', true);
    }
  });

};

module.exports.detail = detail;