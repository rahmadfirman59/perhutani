app.controller('pendaftarCtrl', function ($scope, Data, toaster) {
    
//    ------------------

    $scope.dataPeserta = [
        {
            "Nama" : "Muh Tantowi Lathif",
            "asalSekolah" : "SMK TI An Najiah Jombang",
            "ttl" : "Ponorogo, 28 Agustus 1997",
            "alamat" : "Greenland at Tidar Blok L No 08"
        },
        {
            "Nama" : "faried Wahyu",
            "asalSekolah" : "SMK Telkom Malang",
            "ttl" : "Blitar, 08 Maret 1994",
            "alamat" : "Blitar Jawa Timur",
        },
        {
            "Nama" : "Yulianto Frandi",
            "asalSekolah" : "Wearnes Malang",
            "ttl" : "Mojokerto, 11 Januari 1990",
            "alamat" : "Pacet Mojokerto Jawa Timur",
        },
        {
            "Nama" : "Ahmad Ismail",
            "asalSekolah" : "SMK 1 Mojokerto",
            "ttl" : "Mojokerto, 23 Februari 1993",
            "alamat" : "Pacet Mojokerto Jawa Timur",
        },
        {
            "Nama" : "Wahyu Agung ",
            "asalSekolah" : "STT Malang",
            "ttl" : "Malang, 27 Desember 1995",
            "alamat" : "Karangploso, Malang Jawa timur",
        },
    ]
    
    
//    -------------------
    //init data
    var tableStateRef;
    var Control_link = "pengguna";
    $scope.displayed = [];
    $scope.is_edit = false;
    $scope.is_view = false;
    $scope.is_create = false;

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

        Data.get(Control_link + '/index', param).then(function (data) {
            $scope.displayed = data.data;
            tableState.pagination.numberOfPages = Math.ceil(data.totalItems / limit);
        });

        $scope.isLoading = false;
    };

    $scope.create = function (form) {
        $scope.is_create = true;
        $scope.is_edit = true;
        $scope.is_view = false;
        $scope.formtitle = "Form Tambah Data";
        $scope.form = {};
    };
    $scope.update = function (form) {
        $scope.is_create = false;
        $scope.is_edit = true;
        $scope.is_view = false;
        $scope.formtitle = "Edit Data : " + form.id;
        $scope.form = {};
        $scope.form.id = form.id;
        $scope.form.username = form.username;
        $scope.form.nama = form.nama;
        $scope.form.email = form.email;
        $scope.form.password = '';
    };
    $scope.view = function (form) {
        $scope.is_create = true;
        $scope.is_edit = true;
        $scope.is_view = true;
        $scope.formtitle = "Lihat Data : " + form.id;
        $scope.form = form;
        $scope.form.id = form.id;
        $scope.form.username = form.username;
        $scope.form.name = form.name;
        $scope.form.email = form.email;
        $scope.form.password = '';
    };

    $scope.save = function (form) {
        var url = (form.id > 0) ? 'pengguna/update/' : 'pengguna/create';
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
    $scope.cekAll = function (cek) {

        angular.forEach($scope.displayed, function ($value, $key) {
            if (cek == true) {
                $value.centang = true;
            } else {
                $value.centang = false;
            }
        });
    };

    $scope.chckedIndexs = [];
    $scope.checkedIndex = function (detail) {
        if ($scope.chckedIndexs.indexOf(detail) === -1) {
            $scope.chckedIndexs.push(detail);
        } else {
            $scope.chckedIndexs.splice($scope.chckedIndexs.indexOf(detail), 1);
        }
    };
    $scope.cancel = function () {
        $scope.is_edit = false;
        $scope.is_view = false;
    };

    $scope.trash = function (row) {
        if (confirm("Apa anda yakin akan MENGHAPUS item ini ?")) {
            row.is_deleted = 1;
            Data.post('pengguna/update/' + row.id, row).then(function (result) {
                $scope.displayed.splice($scope.displayed.indexOf(row), 1);
            });
        }
    };
    $scope.restore = function (row) {
        if (confirm("Apa anda yakin akan MERESTORE item ini ?")) {
            row.is_deleted = 0;
            Data.post('pengguna/update/' + row.id, row).then(function (result) {
                $scope.displayed.splice($scope.displayed.indexOf(row), 1);
            });
        }
    };
    $scope.delete = function (row) {
        if (confirm("Apa anda yakin akan MENGHAPUS PERMANENT item ini ?")) {
            Data.delete('pengguna/delete/' + row.id).then(function (result) {
                $scope.displayed.splice($scope.displayed.indexOf(row), 1);
            });
        }
    };


})
