var header = function ($scope, $http) {
  $scope.plans = null;
  $scope.plan  = null;

  setTimeout(function () {
    var rp_plans = angular.element('#rp-plans').prop('value');

    if (rp_plans) {
      $http.get(rp_plans)
        .success(function (data, status, headers, config) {
          if (status == 200) {
            if (data.plans != null) {
              $scope.plans = data.plans;
            }
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
    }
  }, 1000);

  $('#plans').change(function () {
    var id = this.value;

    $scope.plan = $.grep($scope.plans, function (plan, key) {
      return plan.id == id;
    });

    $scope.plan      = $scope.plan[0];
    var plan         = angular.fromJson($scope.plan.plan);
    $scope.plan.plan = plan;

    $scope.$apply();
  });

};

module.exports.header = header;
