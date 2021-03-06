app.controller('frontendCtrl', function ($http,$modal, $scope, Data, toaster, $state, $stateParams, FileUploader) {
  var Control_link = 'form';
  $scope.form = {};
  $scope.form.kewarganegaraan = 'Warga Negara Indonesia';
  $scope.is_formDaftar = true;
  $scope.is_success = false;
  $scope.is_nilai = true;
  // swal("Here's a message!");





  $scope.tambahAnggota = function() {
    var newDet = {
      nama: '',
    }
    $scope.listAnggota.push(newDet);
  };
  $scope.tambahLogistik = function() {
    var newDet = {
      nama: '',
    }
    $scope.listLogistik.push(newDet);
  };
  $scope.getProvinsi = function() {
    Data.get('form/provinsi').then(function (data) {
      $scope.provinsi = data.data;
    });
  };
  $scope.getKabKot = function(idkabkot) {
    Data.get('form/kabupaten/'+idkabkot).then(function (data) {
      $scope.kabkot = data.data;
    });
  };
  $scope.getKecamatan = function(idkecamatan) {
    Data.get('form/kecamatan/'+idkecamatan).then(function (data) {
      $scope.kecamatan = data.data;
    });
  };
  $scope.getDesKel = function(idDeskel) {
    Data.get('form/deskel/'+idDeskel).then(function (data) {
      $scope.deskel = data.data;
    });
  };

  $scope.getProvinsi();




  $scope.hapusAnggota = function(paramindex) {
    // swal("Hello world!");

    if (confirm("Apa anda yakin akan MENGHAPUS item ini? ")) {
      var comArr = eval($scope.listAnggota);
      if (comArr.length > 1) {
        $scope.listAnggota.splice(paramindex, 1);
      } else {
        alert("Something gone wrong");
      }
    }
  };
  $scope.hapusLogistik = function(paramindex) {
    if (confirm("Apa anda yakin akan MENGHAPUS item ini? ")) {
      var comArr = eval($scope.listLogistik);
      if (comArr.length > 1) {
        $scope.listLogistik.splice(paramindex, 1);
      } else {
        alert("Something gone wrong");
      }
    }
  };
  $scope.listAnggota = [{
    nama: ''
  }];
  $scope.listLogistik = [{
    nama: ''
  }];
  $scope.listDarurat = [{
    nama: ''
  },{
    nama: ''
  }

];

$scope.save = function (form,detail,perlengkapan,logistik,darurat) {
  var url = 'form/create';
  var data = {
    form:form,
    anggota:detail,
    perlengkapan:perlengkapan,
    logistik:logistik,
    darurat:darurat
  }

  Data.post(url, data).then(function (result) {

    if (result.status == 0) {
      toaster.pop('error', "Terjadi Kesalahan", result.errors);
    } else {
      // toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
      swal("Pendaftaran berhasil", "Data yang anda akad diverivikasi oleh tim kami,mohon tunggu info selanjutnya melalui Email");
      $scope.form = '';
      $scope.listAnggota = [{
        // no_ijazah: ''
      }];
      $scope.perlengkapan = '';
      $scope.listLogistik = [{
        nama: ''
      }];

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
$scope.open3 = function ($event) {
  $event.preventDefault();
  $event.stopPropagation();
  $scope.opened3= true;
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
        toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
        $state.reload();
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
