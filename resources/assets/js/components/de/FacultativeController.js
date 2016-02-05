var facultative = function ($rootScope, $scope, $http, $compile, $filter) {
  $scope.approved    = false;
  $scope.surcharge   = false;
  $scope.state       = false;
  $scope.observation = true;

  $scope.formData.approved   = 0;
  $scope.formData.surcharge  = 0;
  $scope.formData.percentage = 0;
  $scope.formData.state      = null;
  $scope.formData.mc_id      = null;

  $scope.record = [];

  /**
   * Process create form
   * @param  {[type]} event [description]
   */
  $scope.process = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $rootScope.dataOptions       = data.states;
          $rootScope.currentOption     = $rootScope.dataOptions[0];
          $scope.formData.current_rate = data.current_rate;
          $scope.formData.final_rate   = data.current_rate;
          $scope.formData.emails       = data.user_email;

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /**
   * Process store
   * @param  {[type]} event [description]
   */
  $scope.store = function (event) {
    event.preventDefault();

    $scope.easyLoading('#popup', 'dark', true);

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
      }).finally(function () {
        $scope.easyLoading('#popup', '', false);
      });

  };

  /**
   * Get Observation process
   * @param  {[type]} event [description]
   */
  $scope.observation = function (event) {
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
   * Answer update process
   * @param  {[type]} event [description]
   */
  $scope.storeAnswer = function (event) {
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

      $scope.easyLoading('#popup', 'dark', true);

      $http.get(_mc, {

      }).success(function (data, status, headers, config) {
          if (status == 200) {
            $scope.mcData.mcid = data.mc_id;

            mcForm.html($compile(data.payload)($scope));
          }
        }).error(function (err, status, headers, config) {
          console.log(err);
        }).finally(function () {
          $scope.easyLoading('#popup', '', false);
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

    $scope.easyLoading('#popup', 'dark', true);

    var action = $scope.getActionAttribute(event);

    CSRF_TOKEN = $scope.csrf_token();

    $http({
      method: 'POST',
      url: action,
      data: $.param($scope.mcData),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': CSRF_TOKEN
      }
    }).success(function (data, status, headers, config) {
        $scope.errors = {};

        if (status == 200) {
          $scope.formData.mc_id = data.mc_id;
          $scope.success        = { medical_certificate: true };
          $scope.mcEnabled      = false;

          $scope.submitForm('#form-fa');
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

  $scope.finalRate = function () {
    var percentage   = $scope.formData.percentage;
    var current_rate = $scope.formData.current_rate;
    var final_rate   = $filter('number')(((percentage/100) + current_rate), 2);

    $scope.formData.final_rate = final_rate;
  };

  $scope.readEdit = function (event, value) {
    var rp_id = event.target.attributes['data-rp-id'].value;
    var id    = event.target.attributes['data-record'].value;
    var url   = angular.element('#read-edit').prop('value');
    url       = url.replace(':rp_id', rp_id);
    url       = url.replace(':id', id);

    CSRF_TOKEN = $scope.csrf_token();

    console.log($.param({read: value}));

    $http.put(url, $.param({read: value}), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': CSRF_TOKEN
      }
    }).success(function (data, status, headers, config) {
        // console.log(data);
      })
      .error(function (err, status, header, config) {
        console.log(err);
      });
  };

  $scope.readToBoolean = function (value) {
    return Boolean(value);
  };

};

module.exports.facultative = facultative;
