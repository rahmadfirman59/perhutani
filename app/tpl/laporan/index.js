app.controller('laporanCtrl', function ($scope, Data, toaster) {

    $scope.form = {};

    $scope.open1 = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened1 = true;
    };
    $scope.open2 = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened2 = true;
    };


    $scope.save = function (form) {
        Data.post('laporan/view', form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                console.log(result);
                $scope.hasil = result.data;
                $is_tampil = true;
                // toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
            }
        });
    };
});
