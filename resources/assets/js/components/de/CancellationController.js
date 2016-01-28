var cancellation = function ($scope, $http) {

  /**
   * Header Canceled create
   * @param  {[type]} event [description]
   */
  $scope.cancelCreate = function (event) {
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

  /**
   * Header Canceled store
   * @param  {[type]} event [description]
   */
  $scope.cancelStore = function (event) {
    event.preventDefault();

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
          $scope.success = { cancellation: true };
          $scope.redirect(data.location);
        }
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

module.exports.cancellation = cancellation;