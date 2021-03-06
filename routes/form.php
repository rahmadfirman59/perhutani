<?php
post('/form/create', function() {


    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);

    // print_r($params);
    // exit();


    $awal = strtotime($params['form']['tanggal_naik']);
    $akhir = strtotime($params['form']['tanggal_turun']);
    $lahir = strtotime($params['form']['tanggal_lahir']);

    $naik = date("Y-m-d",$awal);
    $turun = date("Y-m-d",$akhir);
    $datalahir = date("Y-m-d",$lahir);
    $tgl_naik = strtotime($naik);
    $tgl_turun = strtotime($turun);
    $tgl_lahir = strtotime($datalahir);
    $params['form']['tgl_naik']  = $tgl_naik;
    $params['form']['tgl_turun']  = $tgl_turun;
    $params['form']['tgl_lahir']  = $tgl_lahir;




    $anggota  = $params['anggota'];
    $perlengkapan = $params['perlengkapan'];
    $logistik = $params['logistik'];
    $darurat = $params['darurat'];
    $params['form']['register'] = generateKode();
    $model = $sql->insert("m_pendaki",$params['form']);
    $perlengkapan['m_pendaki_id'] = $model->id;
    $model2 = $sql->insert("m_pendaki_perlengkapan",$perlengkapan);

    // $ketua['nama'] = $params['form']['nama'];
    // $ketua['no_identitas'] = $params['form']['no_identitas'];
    // $ketua['kelamin'] = "Laki-Laki";
    // array_unshift($anggota,$ketua);


    foreach ($anggota as $value){
        // $value['karcis'] = generateKarcis();
        $value['m_pendaki_id'] = $model->id;
        $detail = $sql->insert("m_pendaki_anggota",$value);
    }

    foreach ($logistik as $vals){
        $vals['m_pendaki_id'] = $model->id;
        $detail2 = $sql->insert("m_pendaki_logistik",$vals);

    }

    foreach ($darurat as $val) {
      // code...
      $val['m_pendaki_id'] = $model->id;
      $detail3 = $sql->insert("m_pendaki_darurat",$val);
    }

    if($model){
        echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
    }else{
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
    }


});

get('/form/provinsi', function() {
    // check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from provinces");

    echo json_encode(array('status' => 1, 'data' => (array) $models));
});

get('/form/kabupaten/:id', function($id) {
    // check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from regencies where province_id = {$id}");
    echo json_encode(array('status' => 1, 'data' => (array) $models));
});
get('/form/kecamatan/:id', function($idkecamatan) {
    // check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from districts where regency_id = {$idkecamatan}");
    echo json_encode(array('status' => 1, 'data' => (array) $models));
});
get('/form/deskel/:id', function($idDeskel) {
    // check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from villages where district_id = {$idDeskel}");
    echo json_encode(array('status' => 1, 'data' => (array) $models));
});
