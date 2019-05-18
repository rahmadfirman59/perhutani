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

    $scope.is_tampil = false;


    $scope.save = function (form) {
        Data.post('laporan/view', form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                console.log(result);
                $scope.dataHasil = result.data;
                $scope.is_tampil = true;
                // toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
            }
        });
    };
    $scope.print = function(data){

        Data.post('laporan/print', data).then(function (result) {
            $scope.is_edit = false;
            $scope.is_view = false;
          });
    }
});
