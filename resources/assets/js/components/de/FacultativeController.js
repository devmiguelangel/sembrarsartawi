var facultative = function ($scope, $http) {
  $scope.approved  = false;
  $scope.surcharge = false;
  $scope.state     = false;

  $scope.process = function (event) {
    event.preventDefault();

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          console.log(data);
          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      });

  };

};

module.exports.facultative = facultative;