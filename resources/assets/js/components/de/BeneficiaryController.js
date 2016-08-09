var beneficiary = function($rootScope, $scope, $http){
  
  /**
   * Beneficiary store
   * @param  {[type]} event [description]
   */
  $scope.store = function (event) {
    event.preventDefault();

    if (! $rootScope.submitted) {
      $rootScope.submitted = true;

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
            $scope.success = { beneficiary: true };
            $scope.redirect(data.location);
          }
        })
        .error(function (err, status, headers, config) {
          $rootScope.submitted = false;

          if (status == 422) {
            $scope.errors = err;
          } else if (status == 500) {
            console.log('Unauthorized action.');
          }

          console.log(err);
        }).finally(function () {
          $scope.easyLoading('#popup', '', false);
        });
    }
  };

  /**
   * Beneficiary edit
   * @param  {[type]} event [description]
   */
  $scope.update = function (event) {
    event.preventDefault();

    if (! $rootScope.submitted) {
      $rootScope.submitted = true;
      
      $scope.easyLoading('#popup', 'dark', true);

      var action = $scope.getActionAttribute(event);

      CSRF_TOKEN = $scope.csrf_token();

      $http({
        method: 'PUT',
        url: action,
        data: $.param($scope.formData),
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      }).success(function (data, status, headers, config) {
          $scope.errors = {};

          if (status == 200) {
            $scope.success = { beneficiary: true };
            $scope.redirect(data.location);
          }
        })
        .error(function (err, status, headers, config) {
          $rootScope.submitted = false;

          if (status == 422) {
            $scope.errors = err;
          } else if (status == 500) {
            console.log('Unauthorized action.');
          }

          console.log(err);
        }).finally(function () {
          $scope.easyLoading('#popup', '', false);
        });
    }
  };

};

module.exports.beneficiary = beneficiary;