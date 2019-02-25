<?php



post('/form/create', function() {
    check_access(array('admin' => true));

    $params = json_decode(file_get_contents("php://input"), true);
    print_r($params);
    exit();

    $mulai      = date('Y-m-d ', strtotime($params['form']['tanggal_naik']));
    $selesai      = date('Y-m-d ', strtotime($params['form']['tanggal_turun']));
    $params['tanggal_naik']  = $mulai;
    $params['tanggal_turun']  = $selesai;





    $model = $sql->insert("m_pendaki",$params['form']);

    if (cek_setting($params) === true) {
        $sql = new LandaDb();
        $model = $sql->update('m_web_setting', $params, array('id' => $params['id']));

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_setting($params)), JSON_PRETTY_PRINT);
    }
});
