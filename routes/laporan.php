<?php



post('/laporan/view', function() {


    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);



    $awal = strtotime($params['tanggal_awal']);
    $akhir = strtotime($params['tanggal_akhir']);
    $awals = date("Y-m-d ",$awal);
    $akhirs = date("Y-m-d ",$akhir);

    $sql->select("*")
        ->from("m_pendaki")
        ->customWhere("created >= '$awals' AND created   <= '$akhirs'");


    if (isset($params['jalur'])) {
      $sql->andWhere("=","jalur_pendakian",$params['jalur']);
    }
    $model = $sql->findAll();

    foreach ($model as $key => $value) {
    $province = $sql->find("select * from provinces where id = {$value->provinsi}");
    $kabkot = $sql->find("select * from regencies where id = {$value->kabkot}");
     $model[$key] = (array)$value;

     $ang = $sql->select("*")
                ->from("m_pendaki_anggota")
                ->where("=","m_pendaki_id",$value->id)
                ->findAll();
     $model[$key]['jml_anggota'] = count($ang);
     $model[$key]['tgl_naik'] = date("d-m-Y",$value->tgl_naik);
     $model[$key]['tgl_turun'] = date("d-m-Y",$value->tgl_turun);
     $model[$key]['tgl_daftar'] = date("d-m-Y",strtotime($value->created));
     $model[$key]['provinsi'] = $province->name;
       $model[$key]['kabkot'] = $kabkot->name;
    }

    $tanggal_awal = date("d m Y",$awal);
    $tanggal_akhir = date("d m Y",$akhir);


    if($model){
        echo json_encode(array('status' => 1, 'data' => (array) $model,'awal'=>$tanggal_awal,'akhir' => $tanggal_akhir), JSON_PRETTY_PRINT);
    }else{
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data tidak Ada'), JSON_PRETTY_PRINT);
    }
});
post('/laporan/print', function() {

    $params = json_decode(file_get_contents("php://input"), true);

    $dompdf = new \Dompdf\Dompdf();
    ob_start();
    require('format.php');
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $output = $dompdf->output();
    $dompdf->stream("Laporan Pendaki", array("Attachment"=>1));

});
