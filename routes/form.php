<?php



post('/form/create', function() {


    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);

    // print_r($params);
    // exit();

    $awal = strtotime($params['form']['tanggal_naik']);
    $akhir = strtotime($params['form']['tanggal_turun']);

    $naik = date("Y-m-d",$awal);
    $turun = date("Y-m-d",$akhir);
    $tgl_naik = strtotime($naik);
    $tgl_turun = strtotime($turun);
    $params['form']['tgl_naik']  = $tgl_naik;
    $params['form']['tgl_turun']  = $tgl_turun;




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
