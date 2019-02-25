app.controller('frontendCtrl', function ($modal, $scope, Data, toaster, $state, $stateParams, FileUploader) {
    var Control_link = 'form';
    $scope.form = {};
    $scope.form.kewarganegaraan = 'Warga Negara Indonesia';

    $scope.is_formDaftar = true;
    $scope.is_success = false;
    $scope.is_nilai = true;
    /**GET DOKUMEN MULAI*/
    Data.get(Control_link + '/getDokumen').then(function (data) {
        $scope.getDokumen = data.data;
    });
    /**GET DOKUMEN SELESAI*/

//    data sekolah mulai------------------

//    data sekolah selesai-----------------

//    data alamat mulai--------------------
    $scope.cariKota = function ($query) {
        if ($query.length >= 3) {
            Data.get(Control_link + '/cariKota', {nama: $query}).then(function (data) {
                $scope.listKotaLahir = data.data;
            });
        }
    };
    Data.get(Control_link + '/getProvinsi/').then(function (data) {
        $scope.getProvinsi = data.data;
    });
    $scope.getKecamatan = function (id) {
        Data.get(Control_link + '/getKecamatan/' + id).then(function (data) {
            $scope.kecamatan = data.data;
            $scope.alamat();
        });
    }
    $scope.getKecamatan2 = function (id) {
        Data.get(Control_link + '/getKecamatan/' + id).then(function (data) {
            $scope.kecamatan2 = data.data;
            $scope.alamatOrangTua();
        });
    }
    $scope.kotaLahir = function (isi) {
        $scope.form.kota_lahir = isi;
    }
//    data alamat selesai------------------------

//data wali mulai---------------------
    $scope.wali = function (isi) {
        $scope.form.nama_wali = isi;
    }

    $scope.cekWali = function (id) {
        if (id == '0') {
            $scope.form.nama_wali = '';
        } else {
            $scope.form.status_wali = undefined;
            $scope.form.nama_wali = $scope.form.nama_orang_tua;
        }
    }



    $scope.cekAlamat = function (id) {
        if (id == '0') {
            $scope.form.alamat_orang_tua = '';
            Data.get(Control_link + '/getProvinsi/').then(function (data) {
                $scope.getProvinsi1 = data.data;
            });
        } else {
            $scope.form.alamat_orang_tua = $scope.form.alamat;
        }
    }

    $scope.alamatOrangTua = function (isi) {
        $scope.form.alamat_orang_tua = $scope.form.alamat_orang_tua2 + ', Kec. ' + $scope.form.kecamatanOrangTua.nama + ', ' + $scope.form.kotaOrangTua.kota + ', Prov. ' + $scope.form.kotaOrangTua.provinsi;
    }

    $scope.cekWarga = function (id) {
        if (id == '0') {
            $scope.form.alamat_orang_tua = '';
            $scope.form.kota_lahir = '';
        } else {
            $scope.form.alamat_orang_tua = $scope.form.alamat;
        }
        console.log($scope.form);
    }
//    data wali selesai ---------------
    $scope.cekRaport = function (id) {
        $scope.form.modeNilai = id;
    }


    $scope.selesai = function (form) {

        $scope.uploader.uploadAll();
        $scope.data = {};
        if (form.jenis_sekolah == 'Pondok Putra') {
            $scope.data.nilai = false;
        } else if (form.modeNilai == '0') {
            $scope.data.nilai = false;
        } else {
            $scope.data.nilai = true;
        }
        $scope.data.gelombang_id = form.gelombang_id;
        $scope.data.sekolah_tujuan = $scope.getSekolah.nama;
        $scope.data.sekolah_id = $scope.getSekolah.id;
        $scope.data.type = form.pilihan;
        $scope.data.jenis_kelamin = form.jenis_kelamin;
        $scope.data.nama = form.nama;

      
        $scope.data.telepon = form.telepon;
        if (form.kota_lahir.kota == undefined) {
            $scope.data.kota_lahir = form.kota_lahir;
        } else {
            $scope.data.kota_lahir = form.kota_lahir.kota;
        }

        $scope.data.tanggal_lahir = form.tanggal_lahir;
        $scope.data.kewarganegaraan = form.kewarganegaraan;
        $scope.data.alamat = form.alamat;
        $scope.data.asal_sekolah = form.asal_sekolah;
        $scope.data.gelombang = form.gelombang;
        $scope.data.nama_orang_tua = form.nama_orang_tua;
        $scope.data.nama_wali = form.nama_wali;
        $scope.data.alamat_wali = form.alamat_orang_tua;
        if (form.status_wali == undefined) {
            $scope.data.status_wali = 'Orang Tua';
        } else {
            $scope.data.status_wali = form.status_wali;
        }
        $scope.data.nilai1 = {
            'pendidikan_agama': $scope.form.nilai1_1,
            'bahasa_indonesia': $scope.form.nilai1_2,
            'bahasa_inggris': $scope.form.nilai1_3,
            'matematika': $scope.form.nilai1_4,
            'ipa': $scope.form.nilai1_5
        };
        $scope.data.nilai2 = {
            'pendidikan_agama': $scope.form.nilai2_1,
            'bahasa_indonesia': $scope.form.nilai2_2,
            'bahasa_inggris': $scope.form.nilai2_3,
            'matematika': $scope.form.nilai2_4,
            'ipa': $scope.form.nilai2_5
        };
        $scope.data.nilai3 = {
            'pendidikan_agama': $scope.form.nilai3_1,
            'bahasa_indonesia': $scope.form.nilai3_2,
            'bahasa_inggris': $scope.form.nilai3_3,
            'matematika': $scope.form.nilai3_4,
            'ipa': $scope.form.nilai3_5
        };
        if (form.modeNilai == 1) {
            if (form.nilai1_1 == undefined || form.nilai1_2 == undefined || form.nilai1_3 == undefined || form.nilai1_4 == undefined || form.nilai1_5 == undefined) {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else if (form.nilai1_1 == '' || form.nilai1_2 == '' || form.nilai1_3 == '' || form.nilai1_4 == '' || form.nilai1_5 == '') {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else if (form.nilai2_1 == undefined || form.nilai2_2 == undefined || form.nilai2_3 == undefined || form.nilai2_4 == undefined || form.nilai2_5 == undefined) {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else if (form.nilai2_1 == '' || form.nilai2_2 == '' || form.nilai2_3 == '' || form.nilai2_4 == '' || form.nilai2_5 == '') {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else if (form.nilai3_1 == undefined || form.nilai3_2 == undefined || form.nilai3_3 == undefined || form.nilai3_4 == undefined || form.nilai3_5 == undefined) {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else if (form.nilai3_1 == '' || form.nilai3_2 == '' || form.nilai3_3 == '' || form.nilai3_4 == '' || form.nilai3_5 == '') {
                toaster.pop('error', "Terjadi Kesalahan!", "Nilai Belum Lengkap");
            } else {
                var data = $scope.data;
                var modalInstance = $modal.open({
                    templateUrl: 'tpl/site/modal.html',
                    controller: 'modalCtrl',
                    size: 'md',
                    backdrop: 'static',
                    resolve: {
                        form: function () {
                            return data;
                        }
                    }
                });
            }
        } else {
            var data = $scope.data;
            var modalInstance = $modal.open({
                templateUrl: 'tpl/site/modal.html',
                controller: 'modalCtrl',
                size: 'md',
                backdrop: 'static',
                resolve: {
                    form: function () {
                        return data;
                    }
                }
            });
        }
        modalInstance.result.then(function (result) {
//            console.log(result);
            $scope.isiData = result;
            $scope.is_formDaftar = false;
            $scope.is_success = true;
        }, function () {

        })
    };
    $scope.modalBackdrop = function () {
        Data.get(Control_link + '/getSemuaDataGelombang/' + $stateParams.sekolah_id).then(function (data) {
            var modalInstance = $modal.open({
                templateUrl: 'tpl/site/modalBackdrop.html',
                controller: 'modalBackdropCtrl',
                size: 'md',
                backdrop: 'static',
                resolve: {
                    form: function () {
                        return data.data;
                    }
                }
            });
            modalInstance.result.then(function (result) {
//                $scope.isiData = result;
//                $scope.is_formDaftar = false;
//                $scope.is_success = true;
            }, function () {

            })
        });
    }
    $scope.tambahAnggota = function() {
        console.log('tambah detali');
        var newDet = {
            nama: '',
        }
        $scope.listAnggota.push(newDet);
    };
    $scope.hapusAnggota = function(paramindex) {
        if (confirm("Apa anda yakin akan MENGHAPUS item ini? ")) {
            var comArr = eval($scope.listAnggota);
            if (comArr.length > 1) {
                $scope.listAnggota.splice(paramindex, 1);
            } else {
                alert("Something gone wrong");
            }
        }
    };
    $scope.listAnggota = [{
        no_ijazah: ''
    }];

    $scope.save = function (form,detail) {

        var url = 'form/create';
        var data = {
            form:form,
            anggota:detail
        }
        console.log(url)
        Data.post(url, data).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $modalInstance.close(result.data);
                $state.go('site.detail', {id: result.data.no});
            }
        });
    };

//    kalender
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
    //============================GAMBAR===========================//
    var uploader = $scope.uploader = new FileUploader({
        url: Data.base + Control_link + '/upload?folder=raport',
        formData: [],
        removeAfterUpload: true,
    });
    $scope.uploadGambar = function () {
        $scope.uploader.uploadAll();
    };
    uploader.filters.push({
        name: 'imageFilter',
        fn: function (item) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            var x = '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            if (!x) {
                toaster.pop('error', "Jenis gambar tidak sesuai");
            }
            return x;
        }
    });
    uploader.filters.push({
        name: 'sizeFilter',
        fn: function (item) {
            var xz = item.size < 2097152;
            if (!xz) {
                toaster.pop('error', "Ukuran gambar tidak boleh lebih dari 2 MB");
            }
            return xz;
        }
    });
    $scope.gambar = [];
    uploader.onSuccessItem = function (fileItem, response) {
        if (response.answer == 'File transfer completed') {
            $scope.gambar.unshift({img: response.img, id: response.id});
        }
    };
    uploader.onBeforeUploadItem = function (item) {
        item.formData.push({
            id: $scope.form.nama,
        });
    };
    $scope.removeFoto = function (paramindex, namaFoto, pid) {
        Data.post(Control_link + '/removegambar', {id: pid, img: namaFoto}).then(function (data) {
            $scope.gambar.splice(paramindex, 1);
            $scope.form.primary_photo_id = '';
        });
    };
    $scope.gambarzoom = function (id, img) {
        var modalInstance = $modal.open({
            template: '<img src="img/product/' + id + '-700x700-' + img + '" class="img-full" >',
            size: 'md',
        });
    };
    /* sampe di sini*/
    $scope.printDiv = function (divName) {
        /*var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;
         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;*/

        html2canvas(document.getElementById(divName), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                            image: data,
                            width: 500,
                        }]
                };
                pdfMake.createPdf(docDefinition).download("formulir-pendaftaran-sunsal.pdf");
            }
        });
    }
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
    $scope.save = function (form) {
//        console.log(form);
        var url = 'form/create';
        Data.post(url, form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $modalInstance.close(result.data);
                $state.go('site.detail', {id: result.data.no});
            }
        });
    };
})

app.controller('modalBackdropCtrl', function ($state, $scope, toaster, Data, $modalInstance, form) {
    $scope.formmodal = form;
//    console.log($scope.formmodal);
//    $scope.close = function () {
//        $modalInstance.dismiss('cancel');
//    };
})
