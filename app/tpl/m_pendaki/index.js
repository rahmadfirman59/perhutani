app.controller('appPendakiCtrl', function ($http,$scope, Data, toaster) {
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

        $scope.is_edit = true;
        $scope.is_view = true;
        $scope.formtitle = "Lihat Data : " + form.title;
        $scope.form = form;
        $scope.register = form.register;
        Data.get('pendaki/view/'+form.id).then(function (data) {

            $scope.listAnggota = data.anggota;
            $scope.perlengkapan = data.perlengkapan;
            $scope.listLogistik = data.logistik;
            $scope.listDarurat = data.darurat;

        });
    };



    $scope.cancel = function () {
        $scope.is_edit = false;
        $scope.is_view = false;
    };





    $scope.sendmail = function(data){

        Data.post('pendaki/print', data).then(function (result) {
            $scope.is_edit = false;
            $scope.is_view = false;
            // $scope.is_edit = false;
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $scope.callServer(tableStateRef); //reload grid ulang
                toaster.pop('success', "Berhasil", "Email Berhasil dikirim");
            }
            // $scope.callServer(tableStateRef); //reload grid ulang
            // toaster.pop('success', "Berhasil", "Email Berhasil dikirim");
        });
    }
    $scope.naik = function(row){
        row.is_naik = 1;

        Data.post('pendaki/naik', row).then(function (result){
          $scope.is_edit = false;
          $scope.is_view = false;
          // location.reload();
          $scope.callServer(tableStateRef); //reload grid ulang
          toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
      });

    }
    $scope.turun = function(row){
        row.is_turun = 1;
        Data.post('pendaki/turun', row).then(function (result){
          $scope.is_edit = false;
          $scope.is_view = false;
          // location.reload();
          $scope.callServer(tableStateRef); //reload grid ulang
          toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
      });

    }
});
