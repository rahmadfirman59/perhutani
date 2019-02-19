app.controller('cobaCtrl', function ($modal, $scope, Data, toaster, $state) {
    
    $scope.form = {};
    $scope.form.nama = 'Ismail';
    
    $scope.selesai = function () {
        var modalInstance = $modal.open({
            templateUrl: 'tpl/coba/modal.html',
            controller: 'modalCtrl',
            size: 'md',
            backdrop: 'static',
            resolve: {
                form: function () {
                    return $scope.form;
                }
            }
        });


    };
});
app.controller('modalCtrl', function ($state, $scope, toaster, Data, $modalInstance, form) {
    $scope.formmodal = form;
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };
    $scope.selesai_ujian = function () {
//        $scope.formmodal.nama = 'Hana';
        $modalInstance.dismiss('cancel');
//        toaster.pop('success', "BERIKUT HASIL UJIAN ANDA", 'Ujian telah berhasil di akhiri');
    }


})