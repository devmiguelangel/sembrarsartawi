var detailEdit = function ($rootScope, $scope, $http) {

  /**
   * Balance edit
   * @param  {[type]} event [description]
   */
  this.editBalance = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $scope.formData.amount_requested    = data.amount_requested;
          $scope.formData.amount_requested_bs = data.amount_requested_bs;
          $scope.formData.balance             = data.balance;
          $scope.formData.movement_type       = data.movement_type;

          if (Number(data.cumulus || 0) == 0) {
            $scope.formData.cumulus = $scope.formData.amount_requested_bs;
          } else {
            $scope.formData.cumulus = data.cumulus;
          }

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /**
   * Balance update
   * @param  {[type]} event [description]
   */
  this.updateBalance = function (event) {
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

  /**
   * Beneficiary create
   * @param  {[type]} event [description]
   */
  this.createBeneficiary = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /**
   * Beneficiary edit
   * @param  {[type]} event [description]
   */
  this.editBeneficiary = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $scope.formData.beneficiary_id   = data.beneficiary[0].id;
          $scope.formData.first_name       = data.beneficiary[0].first_name;
          $scope.formData.last_name        = data.beneficiary[0].last_name;
          $scope.formData.mother_last_name = data.beneficiary[0].mother_last_name;
          $scope.formData.relationship     = data.beneficiary[0].relationship;
          $scope.formData.dni              = data.beneficiary[0].dni;
          $scope.formData.extension        = data.beneficiary[0].extension;

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /*
  * Cumulus calculate
  */
  $scope.cumulus = function () {
    if ($scope.formData.movement_type == 'AD') {
      var amount_requested = Number($scope.formData.amount_requested_bs || 0);
      var balance          = Number($scope.formData.balance || 0);

      $scope.formData.cumulus = amount_requested + balance;
    }
  };

  $scope.$watch('formData.cumulus', function(value, oldValue, scope) {
    if (scope.formData.movement_type == 'LC') {
      var balance = Number(scope.formData.balance || 0);

      if (value >= scope.formData.amount_requested_bs && value >= balance) {
        scope.data.cumulus = false;
      } else {
        scope.data.cumulus = true;
      }
    }
  });

  /**
   * Client Remove
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.delete = function (event) {
    event.preventDefault();

    var url     = event.target.attributes.href.value;
    var message = 'Desea eliminar el registro de este titular?';
    CSRF_TOKEN  = $scope.csrf_token();
    
    bootbox.confirm(message, function(result) {
      if (result) {
        $http.delete(url, {
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': CSRF_TOKEN
          }
        })
         .then(function (response) {
            if (response.status == 200) {
              $scope.redirect(response.data.location);
            }
          }, function (response) {
            console.log('Unauthorized action.');
          });
      }
    });
  };

};

module.exports.detailEdit = detailEdit;
