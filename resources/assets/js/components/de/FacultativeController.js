var facultative = function ($rootScope, $scope, $http) {
  $scope.approved  = false;
  $scope.surcharge = false;
  $scope.state     = false;

  $scope.formData = {
    approved: 0,
    surcharge: 0,
    percentage: 0,
    state: null,
    emails: [
    ]
  };

  $scope.process = function (event) {
    event.preventDefault();

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $rootScope.dataOptions   = data.states;
          $rootScope.currentOption = $rootScope.dataOptions[0];

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      });

  };

  $scope.store = function (event) {
    event.preventDefault();

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    $scope.formData.emails = $scope.formData.emails.split(',');

    console.log($scope.formData);

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
        $scope.formData.emails = $scope.formData.emails.join(',');

        if (status == 200) {
          // $scope.success = { beneficiary: true };
          $scope.redirect(data.location);
        }
      })
      .error(function (err, status, headers, config) {
        if (status == 422) {
          angular.forEach($scope.formData.emails, function(value, key){
            if ('emails.' + key in err) {
              err.emails = [
                'El email no es válido'
              ];
            }
          });

          $scope.formData.emails = $scope.formData.emails.join(',');

          $scope.errors = err;
        } else if (status == 500) {
          console.log('Unauthorized action.');
        }

        console.log(err);
      });

  };

  $scope.stateChange = function () {
    $scope.formData.state = $scope.currentOption;
  };

  $scope.$watch('formData.surcharge', function(value, oldValue, scope) {
    if (value == 0) {
      $scope.formData.percentage = 0;
      $scope.formData.final_rate = $scope.formData.current_rate;
    }
  });

};

module.exports.facultative = facultative;