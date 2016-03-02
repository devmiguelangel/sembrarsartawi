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

  $('#payment_method').change(function () {
    var payment_method = this.value;

    if (payment_method == 'CO') {
      $('#period option[value="Y"]').prop('selected', true);
      $('#period option:not(:selected)').prop('disabled', true);
      $('#account_number').prop('value', 0).prop('readonly', true);
      $('#period').trigger('change');
    } else {
      $('#period option[value=""]').prop('selected', true);
      $('#period option').prop('disabled', false);
      $('#account_number').prop('value', '').prop('readonly', false);
      $('#period').trigger('change');
    }
  });

};

module.exports.header = header;
