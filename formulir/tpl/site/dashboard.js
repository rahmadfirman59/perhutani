app.controller('dashboardCtrl', function ($modal, $scope, Data, toaster, $state, $stateParams) {
    var Control_link = 'form';
  

//    data sekolah mulai------------------
    Data.get(Control_link + '/getFullSekolah').then(function (data) {
        $scope.getSekolah = data.data;
    });

});