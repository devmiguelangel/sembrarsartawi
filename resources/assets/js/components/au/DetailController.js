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
          $rootScope.amount_max      = data.amount_max;

          $scope.formData.vehicle_type  = null;
          $scope.formData.category      = null;
          $scope.formData.vehicle_make  = null;
          $scope.formData.vehicle_model = null;
          $scope.formData.year          = '';
          $scope.formData.year_old      = '';
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

  /**
   * Year old
   * @param  {[type]} value    [description]
   * @param  {[type]} oldValue [description]
   * @param  {[type]} scope)   {               if (value ! [description]
   * @return {[type]}          [description]
   */
  $scope.$watch('formData.year', function(value, oldValue, scope) {
    if (value == 'old') {
      $scope.year_old = true;
    } else {
      $scope.year_old = false;
    }
  });

  /**
   * Category by Vehicle Type
   * @param  {[type]} value    [description]
   * @param  {[type]} oldValue [description]
   * @param  {[type]} scope)   {               if (value ! [description]
   * @return {[type]}          [description]
   */
  $scope.$watch('formData.vehicle_type', function(value, oldValue, scope) {
    if (value != null) {
      $scope.formData.category = value.category;
      angular.element('#category option:not(:selected)').prop('disabled', true);
    }
  });

  /**
   * Insured Value
   * @param  {[type]} value    [description]
   * @param  {[type]} oldValue [description]
   * @param  {[type]} scope)   {               if (value [description]
   * @return {[type]}          [description]
   */
  $scope.$watch('formData.insured_value', function(value, oldValue, scope) {
    if (value > scope.amount_max) {
      $scope.insured_value = true;
    } else {
      $scope.insured_value = false;
    }
  });

  $scope.delete = function (event) {
    event.preventDefault();

    var url     = event.target.attributes.href.value;
    var message = 'Desea eliminar el registro de este vehículo?';
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

  /**
   * Vehicle edit form
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.edit = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.attributes.href.value;

    $http.get(url, {})
      .then(function (response) {
          if (response.status == 200) {
            var data = response.data;

            $rootScope.data.types      = data.types;
            $rootScope.data.makes      = data.makes;
            $rootScope.data.categories = data.categories;

            $scope.formData.vehicle_type  = data.detail.vehicle_type;
            $scope.formData.vehicle_make  = data.detail.vehicle_make;
            $scope.formData.vehicle_model = data.detail.vehicle_model;
            $scope.formData.year          = data.detail.year;
            $scope.formData.year_old      = data.detail.year;
            $scope.formData.license_plate = data.detail.license_plate;
            $scope.formData.use           = data.detail.use;
            $scope.formData.mileage       = data.detail.mileage ? '1' : '0';
            $scope.formData.insured_value = data.detail.insured_value;

            if ($scope.formData.year < data.year_max) {
              $scope.formData.year = 'old';
            }

            $scope.popup(data.payload);

            angular.element('#popup').on('shown.bs.modal', function (e) {
              angular.element('#category option:not(:selected)').prop('disabled', true);
              angular.element('#vehicle-make').triggerHandler('change');
              angular.element('#vehicle-model').triggerHandler('change');
              angular.element('#year option[value=' + $scope.formData.year + ']').prop('selected', true).triggerHandler('change');
              angular.element('#year').triggerHandler('change');
            });
          }
        }, function(response){
          console.log(response);
        }).finally(function () {
          $scope.easyLoading('body', '', false);
        });
  };

  /**
   * Vehicle update
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.update = function (event) {
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
          $scope.success = { vehicle: true };

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

  /**
   * Vehicle edit issuance form
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.editIssuance = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.attributes.href.value;

    $http.get(url, {})
      .then(function (response) {
          if (response.status == 200) {
            var data = response.data;

            $rootScope.data.types         = data.types;
            $rootScope.data.makes         = data.makes;
            $rootScope.data.categories    = data.categories;
            $rootScope.data.insured_value = data.detail.insured_value;
            $rootScope.data.premium       = data.detail.premium;
            $rootScope.data.currency      = data.detail.header.currency;

            $scope.formData.vehicle_type     = data.detail.vehicle_type;
            $scope.formData.vehicle_make     = data.detail.vehicle_make;
            $scope.formData.vehicle_model    = data.detail.vehicle_model;
            $scope.formData.year             = data.detail.year;
            $scope.formData.year_old         = data.detail.year;
            $scope.formData.license_plate    = data.detail.license_plate;
            $scope.formData.use              = data.detail.use;
            $scope.formData.mileage          = data.detail.mileage ? '1' : '0';
            $scope.formData.color            = data.detail.color;
            $scope.formData.engine           = data.detail.engine;
            $scope.formData.chassis          = data.detail.chassis;
            $scope.formData.tonnage_capacity = data.detail.tonnage_capacity;
            $scope.formData.seat_number      = data.detail.seat_number;

            if ($scope.formData.year < data.year_max) {
              $scope.formData.year = 'old';
            }
            
            angular.element('#popup').on('shown.bs.modal', function (e) {
              angular.element('#category option:not(:selected)').prop('disabled', true);
              angular.element('#vehicle-make').triggerHandler('change');
              angular.element('#vehicle-model').triggerHandler('change');
              angular.element('#year option[value=' + $scope.formData.year + ']').prop('selected', true).triggerHandler('change');
              angular.element('#year').triggerHandler('change');
            });

            $scope.popup(data.payload);
          }
        }, function(response){
          console.log(response);
        }).finally(function () {
          $scope.easyLoading('body', '', false);
        });
  };

  /**
   * Vehicle update issuance
   * @param  {[type]} event [description]
   * @return {[type]}       [description]
   */
  $scope.updateIssuance = function (event) {
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
          $scope.success = { vehicle: true };

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

module.exports.detail = detail;