app.controller('settingCtrl', function ($scope, Data, toaster) {

    $scope.form = {};

    Data.get('setting/get').then(function (data) {
        $scope.form = data.data;
    });

    $scope.save = function (form) {

        Data.post('setting/save', form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
            }
        });
    };
});
