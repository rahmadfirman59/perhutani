app.controller('penggunaProfileCtrl', function ($scope, Data, toaster) {

    Data.get('pengguna/profile').then(function (data) {
        $scope.form = {};
        $scope.form.username = data.data.username;
        $scope.form.name = data.data.name;
        $scope.form.email = data.data.email;
        $scope.form.password = '';
    });

    $scope.save = function (form) {
        var url = 'pengguna/updateprofile/';
//        form.settings = $scope.app.settings;
        Data.post(url, form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $scope.is_edit = false;
                toaster.pop('success', "Berhasil", "Data berhasil tersimpan, sebaiknya anda melakukan logout applikasi kemudian login kembali, untuk memastikan perubahan benar - benar terjadi.");
            }
        });
    };


})
