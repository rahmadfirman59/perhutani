<?php



post('/form/create', function() {


    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);



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

    $model = $sql->insert("m_pendaki",$params['form']);
    $perlengkapan['m_pendaki_id'] = $model->id;


    $model2 = $sql->insert("m_pendaki_perlengkapan",$perlengkapan);

    foreach ($anggota as $value){
        $value['m_pendaki_id'] = $model->id;
        $detail = $sql->insert("m_pendaki_anggota",$value);
    }

    foreach ($logistik as $vals){
        $vals['m_pendaki_id'] = $model->id;
        $detail2 = $sql->insert("m_pendaki_logistik",$vals);

    }



    if($model){
        echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
    }else{
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
    }


});