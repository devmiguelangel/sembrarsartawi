var facultative = function ($rootScope, $scope, $http, $compile) {
  $scope.approved    = false;
  $scope.surcharge   = false;
  $scope.state       = false;
  $scope.observation = true;

  $scope.formData = {
    approved: 0,
    surcharge: 0,
    percentage: 0,
    state: null,
    emails: [
    ]
  };

  $scope.record = [
    
  ];

  /**
   * Process create form
   * @param  {[type]} event [description]
   */
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

  /**
   * Process store
   * @param  {[type]} event [description]
   */
  $scope.store = function (event) {
    event.preventDefault();

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    $scope.formData.emails = $scope.formData.emails.split(',');

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
          $scope.success = { facultative: true };
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

  /**
   * Get Observation process
   * @param  {[type]} event [description]
   */
  $scope.observation = function (event) {
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
   * Answer update process
   * @param  {[type]} event [description]
   */
  $scope.storeAnswer = function (event) {
    event.preventDefault();

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
      });

  };

  /**
   * State observation action
   */
  $scope.stateChange = function () {
    $scope.formData.state = $scope.currentOption;

    if ($scope.currentOption.data_slug == 'me') {
      $scope.observation = false;
      $scope.formData.observation = '--';

      var _mc = angular.element('input#_mc').prop('value');
      var mcForm  = angular.element('#mc-form');

      $scope.mcEnabled = true;

      $http.get(_mc, {

      }).success(function (data, status, headers, config) {
          if (status == 200) {
            mcForm.html($compile(data.payload)($scope));
          }
        }).error(function (err, status, headers, config) {
          console.log(err);
        });

    } else {
      $scope.mcEnabled   = false;
      $scope.observation = true;
      $scope.formData.observation = '';
    }
  };

  /**
   * Approved actions
   * @param  {[type]} value    [description]
   * @param  {[type]} oldValue [description]
   * @param  {[type]} scope)   {               if (value ! [description]
   */
  $scope.$watch('formData.approved', function(value, oldValue, scope) {
    if (value != 2) {
      $scope.formData.observation = '';
    } else if ($scope.currentOption.data_slug == 'me') {
      $scope.observation = false;
      $scope.mcEnabled   = false;
      $scope.formData.observation = '--';
    }
  });

  /**
   * Surcharge actions
   * @param  {[type]} value    [description]
   * @param  {[type]} oldValue [description]
   * @param  {[type]} scope)   {               if (value [description]
   */
  $scope.$watch('formData.surcharge', function(value, oldValue, scope) {
    if (value == 0) {
      $scope.formData.percentage = 0;
      $scope.formData.final_rate = $scope.formData.current_rate;
    }
  });

  /**
   * Medical Certificate store
   * @param  {[type]} event [description]
   */
  $scope.mcStore = function (event) {
    event.preventDefault();

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    // console.log($scope.mcData);
    $http({
      method: 'POST',
      url: action,
      data: $.param($scope.mcData),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': CSRF_TOKEN
      }
    }).success(function (data, status, headers, config) {
        console.log(data);
        $scope.errors = {};

        if (status == 200) {
          // $scope.success = { facultative: true };
          // $scope.redirect(data.location);
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

module.exports.facultative = facultative;