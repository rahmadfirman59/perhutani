app.controller('pencarianCtrl', function ($scope, Data, toaster) {
    $scope.is_view = false;
    $scope.form = {};
    var Control_link = 'apphasil';

    $scope.view = function (no) {
//        window.location.replace("http://localhost/ppdb_sunniyah/formulir/#/"+no);
        window.location.replace("http://ppdb.sunsal.or.id/formulir/#/"+no);
    };
})
