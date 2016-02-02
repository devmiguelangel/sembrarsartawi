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

};

module.exports.detailEdit = detailEdit;