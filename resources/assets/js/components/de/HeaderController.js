var header = function ($scope, $http) {

  /**
   * Request create
   * @param  {[type]} event [description]
   */
  $scope.requestCreate = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $scope.formData.facultative_observation = data.facultative_observation;

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
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
          $scope.success = { facultative: true };
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
      }).finally(function () {
        $scope.easyLoading('#popup', '', false);
      });
  };

  $('#coverage option:not(:selected), ' +
    '#currency option:not(:selected), ' +
    '#type_term option:not(:selected), ' +
    '#credit_product option:not(:selected), ' + 
    '#movement_type option:not(:selected)').prop('disabled', true);

};

module.exports.header = header;
