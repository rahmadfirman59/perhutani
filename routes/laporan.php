<?php



post('/laporan/view', function() {


    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);
    
    $awal = strtotime($params['tanggal_awal']);
    $akhir = strtotime($params['tanggal_akhir']);
    $awals = date("Y-m-d H:i:s",$awal);
    $akhirs = date("Y-m-d H:i:s",$akhir);
    $model = $sql->select("*")
                ->from("m_pendaki")
                ->where(">","created",$awals)
                ->andWhere("<","created",$akhirs)
                ->findAll();
    if($model){
        echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
    }else{
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
    }


});
