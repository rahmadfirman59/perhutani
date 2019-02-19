app.controller('detailCtrl', function ($scope, Data, toaster, $state, $stateParams) {
    $scope.is_view = false;
    $scope.form = {};
    var Control_link = 'form';
    var id = $stateParams.id;

    if (id.toString().length <= 8) {
        Data.get(Control_link + '/md5/' + id).then(function (data) {
            $state.go('site.detail', {id: data.data});
        });
    } else {
        Data.get(Control_link + '/detail/' + id).then(function (data) {
            if (data.data == false) {
                $state.go('site.404');
            } else {
                $scope.isiData = data.data;
            }
        });
    }

    /**GET DOKUMEN MULAI*/
    Data.get(Control_link + '/getDokumen').then(function (data) {
        $scope.getDokumen = data.data;
    });
    /**GET DOKUMEN SELESAI*/

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

    $scope.print = function (divName) {
//        $state.reload();
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
// $state.reload();
    };

})
