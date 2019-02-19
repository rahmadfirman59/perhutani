app.controller('hasilCtrl', function ($scope, Data, toaster) {
    $scope.is_view = false;
    $scope.form = {};
    var Control_link = 'apphasil';

    Data.get(Control_link + '/getSekolah').then(function (data) {
        $scope.getSekolah = data.data;
    });

    Data.get(Control_link + '/getTahun').then(function (data) {
        $scope.getTahun = data.data;
    });

    $scope.gelombang = function (form) {
        Data.get(Control_link + '/getGelombang/' + form.sekolah_id + '/' + form.tahun).then(function (data) {
            if (data.data.length == 0) {
                toaster.pop('error', "Terjadi Kesalahan", "Pengumuman Belum Keluar");
                $scope.getGelombang = undefined;
                $scope.is_view = false;
            } else {
                $scope.getGelombang = data.data;
            }

        });
    }

    $scope.view = function (form) {
        $scope.is_view = true;
        $scope.form = form;
        $scope.callServer(tableStateRef);
    };

    var tableStateRef;
    $scope.displayed = [];


    $scope.callServer = function callServer(tableState) {

        var form = $scope.form;
        tableStateRef = tableState;
        $scope.isLoading = true;
        var offset = tableState.pagination.start || 0;
        var limit = tableState.pagination.number || 999;
        var param = {offset: offset, limit: limit, sekolah_id: form.sekolah_id, gelombang: form.gelombang, tahun: form.tahun};

        if (tableState.sort.predicate) {
            param['sort'] = tableState.sort.predicate;
            param['order'] = tableState.sort.reverse;
        }
        if (tableState.search.predicateObject) {
            param['filter'] = tableState.search.predicateObject;
        }

        Data.get(Control_link + '/getHasilFrontend', param).then(function (data) {
//            console.log(data)
            if (data.publish == 0) {
                $scope.is_view = false;
                toaster.pop('error', "Terjadi Kesalahan", "Pengumuman Belum Keluar");
            } else {
                $scope.displayed = data.data;
                tableState.pagination.numberOfPages = Math.ceil(data.totalItems / limit);
            }
        });

        $scope.isLoading = false;
    };

})
