var client = function ($scope) {
  $scope.submitted = true;

  $scope.submitDe = function (event) {
    if ($scope.submitted) {
      event.preventDefault();

      var form_id = event.target.attributes.id.value;
      var weight  = angular.element('#weight').prop('value');
      var height  = angular.element('#height').prop('value');
      var message = '';
      var confirm = false;

      if (weight < 40 || weight > 140) {
        message += '<strong>Usted ha introducido un peso fuera de los parámetros normales.</strong>';
        confirm = true;
      }

      if (height < 100) {
        if (confirm) {
          message += '<br />';
        }

        message += '<strong>La estatura introducida para la persona es menor a 1 metro (100 cm.)</strong>';
        confirm = true;
      }

      if (confirm) {
        message += '<br /><br /> Desea continuar de todas formas?';
        
        bootbox.confirm(message, function(result) {
          if (result) {
            $scope.submitted = false;
            $scope.submitForm('#' + form_id);
          }
        });
      } else {
        $scope.submitted = false;
        $scope.submitForm('#' + form_id);
      }
    }
  };

};

module.exports.client = client;