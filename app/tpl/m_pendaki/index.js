app.controller('appartikelCtrl', function ($scope, Data, toaster) {
    //init data
    var tableStateRef;



    $scope.displayed = [];
    $scope.form = {};
    $scope.is_edit = false;
    $scope.is_view = false;


    $scope.open1 = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened1 = true;
    };

    $scope.callServer = function callServer(tableState) {
        tableStateRef = tableState;
        $scope.isLoading = true;
        var offset = tableState.pagination.start || 0;
        var limit = tableState.pagination.number || 10;
        var param = {offset: offset, limit: limit};

        if (tableState.sort.predicate) {
            param['sort'] = tableState.sort.predicate;
            param['order'] = tableState.sort.reverse;
        }
        if (tableState.search.predicateObject) {
            param['filter'] = tableState.search.predicateObject;
        }

        Data.get('pendaki/index', param).then(function (data) {
            $scope.displayed = data.data;
            tableState.pagination.numberOfPages = Math.ceil(data.totalItems / limit);
        });

        $scope.isLoading = false;
    };

    $scope.create = function (form) {
        $scope.is_edit = true;
        $scope.is_view = false;
        $scope.formtitle = "Form Tambah Data";
        $scope.form = {};
        $scope.form.date = new Date();
        // $scope.form.publish = '1';
    };

    $scope.update = function (form) {
        $scope.is_edit = true;
        $scope.is_view = false;
        $scope.formtitle = "Edit Data : " + form.title;
        $scope.form = form;
        Data.get('pendaki/view/'+form.id).then(function (data) {
            $scope.listAnggota = data.kategori;
        });
    };

    $scope.view = function (form) {
        console.log(form);
        $scope.is_edit = true;
        $scope.is_view = true;
        $scope.formtitle = "Lihat Data : " + form.title;
        $scope.form = form;
        Data.get('pendaki/view/'+form.id).then(function (data) {
            $scope.listAnggota = data.anggota;
            $scope.perlengkapan = data.perlengkapan;
            $scope.listLogistik = data.logistik;
            
        });
    };

    $scope.save = function (form) {

        var url = (form.id > 0) ? 'appartikel/update/' + form.id : 'appartikel/create/';
        Data.post(url, form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $scope.is_edit = false;
                $scope.callServer(tableStateRef); //reload grid ulang
                toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
            }
        });
    };

    $scope.cancel = function () {
        $scope.is_edit = false;
        $scope.is_view = false;
    };

    $scope.delete = function (row) {
        if (confirm("Apa anda yakin akan MENGHAPUS PERMANENT item ini ?")) {
            Data.delete('appartikel/delete/' + row.id).then(function (result) {
                $scope.displayed.splice($scope.displayed.indexOf(row), 1);
            });
        }
    };

    $scope.setujui = function (row) {
        
        if (confirm("Apa Anda Yakin Akan Menyetujui Data Ini?")) {
          row.is_aprove = 1;
          Data.post('pendaki/setujui', row).then(function (result) {
            $scope.is_edit = false;
            $scope.is_view = false;
          });
        }

    };

    $scope.sendmail = function(id){
        Data.post('pendaki/print', id).then(function (result) {
            $scope.is_edit = false;
            $scope.is_view = false;
          });
    }
});
