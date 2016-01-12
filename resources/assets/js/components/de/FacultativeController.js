var facultative = function ($scope, $http) {
  $scope.approved  = false;
  $scope.surcharge = false;
  $scope.state     = false;

  $scope.formData = {
    approved: 0,
    surcharge: 0,
    percentage: 0,
  };

  $scope.process = function (event) {
    event.preventDefault();

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
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
        console.log(data);
        /*if (status == 200) {
          $scope.success = { beneficiary: true };
          $scope.redirect(data.location);
        }*/
      })
      .error(function (err, status, headers, config) {
        if (status == 422) {
          $scope.errors = err;
        } else if (status == 500) {
          console.log('Unauthorized action.');
        }

        console.log(err);
      });

  };

};

module.exports.facultative = facultative;