var detailEdit = function ($scope, $http) {

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
};

module.exports.detailEdit = detailEdit;