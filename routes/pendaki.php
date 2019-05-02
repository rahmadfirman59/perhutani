<?php

get('/pendaki/view/:id', function($id) {
    check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from m_pendaki_anggota where m_pendaki_id = {$id}");
    $perlengkapan = $sql->find("select * from m_pendaki_perlengkapan where m_pendaki_id = {$id}");
    $logistik = $sql->findAll("select * from m_pendaki_logistik where m_pendaki_id = {$id}");

    echo json_encode(array('status' => 1, 'anggota' => (array) $models,'perlengkapan'=>$perlengkapan,'logistik'=>$logistik));
});





post('/pendaki/setujui', function() {


    check_access(array('admin' => true));
    $params = json_decode(file_get_contents("php://input"), true);
    $sql = new LandaDb();

    $model = $sql->update('m_pendaki', $params, array('id' => $params['id']));

    echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);

});

post('/pendaki/print', function() {

    $params = json_decode(file_get_contents("php://input"), true);
    $id = $params;
    $sql = new LandaDb();

    $kode = generateKode();
    $model = $sql->find("select * from m_pendaki where id = {$id}");
    $anggota = $sql->findAll("select * from m_pendaki_anggota where m_pendaki_id = {$id}");
    $perlengkapan = $sql->find("select * from m_pendaki_perlengkapan where m_pendaki_id = {$id}");
    $logistik = $sql->findAll("select * from m_pendaki_logistik where m_pendaki_id = {$id}");
    $jml_anggota = count($anggota) + 1;
    $awal = date("j M Y",$model->tgl_naik);
    $akhir = date("j M Y",$model->tgl_turun);

    $timeDiff = abs($model->tgl_turun - $model->tgl_naik);
    $numberDays = $timeDiff/86400;
    $numberDays = intval($numberDays);




    $dompdf = new \Dompdf\Dompdf();
    // $page = file_get_contents('test.php');

    ob_start();
    require('test.php');
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("Webslesson", array("Attachment"=>0));

});

get('/pendaki/index', function () {
    check_access(array('login' => true));

    $params = $_REQUEST;
    $filter = array();
    $sort = "id DESC";
    $offset = 0;
    $limit = 10;

    if (isset($params['limit']))
        $limit = $params['limit'];
    if (isset($params['offset']))
        $offset = $params['offset'];

    if (isset($params['sort'])) {
        $sort = $params['sort'];
        if (isset($params['order'])) {
            if ($params['order'] == "false")
                $sort.=" ASC";
            else
                $sort.=" DESC";
        }
    }

    $sql = new LandaDb();
    $sql->select("*")
        ->from('m_pendaki')
        ->limit($limit)
        ->offset($offset)
        ->orderBy($sort);

    if (isset($params['filter'])) {
        $filter = (array) json_decode($params['filter']);
        foreach ($filter as $key => $val) {
            $sql->where('LIKE', $key, $val);
        }
    }

    $model = $sql->findAll();

   foreach ($model as $key => $value){
       $model[$key] = (array) $value;
       $model[$key]['tgl_naik'] = date("d M Y",$value->tgl_naik);
       $model[$key]['tgl_turun'] = date("d M Y",$value->tgl_turun);
   }
    $totalItem = $sql->count();
    $sql->clearQuery();

    if (!empty($model)) {

        echo json_encode(array('status' => 1, 'data' => array_filter($model), 'totalItems' => $totalItem), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => ""), JSON_PRETTY_PRINT);
    }
});
