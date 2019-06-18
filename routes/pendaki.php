<?php

get('/pendaki/view/:id', function($id) {
    check_access(array('login' => true));
    $sql = new LandaDb();
    $models = $sql->findAll("select * from m_pendaki_anggota where m_pendaki_id = {$id}");

    $perlengkapan = $sql->find("select * from m_pendaki_perlengkapan where m_pendaki_id = {$id}");
    $logistik = $sql->findAll("select * from m_pendaki_logistik where m_pendaki_id = {$id}");
    $darurat = $sql->findAll("select * from m_pendaki_darurat where m_pendaki_id = {$id}");

    echo json_encode(array('status' => 1, 'anggota' => (array) $models,'perlengkapan'=>$perlengkapan,'logistik'=>$logistik,'darurat'=>$darurat));
});


post('/pendaki/print', function() {

    $params = json_decode(file_get_contents("php://input"), true);


    
    $id = $params;
    $sql = new LandaDb();
    $mail = new PHPMailer(true);
    $kode = generateKode();
    $model = $sql->find("select * from m_pendaki where id = {$id}");
    $anggota = $sql->findAll("select * from m_pendaki_anggota where m_pendaki_id = {$id}");
    $perlengkapan = $sql->find("select * from m_pendaki_perlengkapan where m_pendaki_id = {$id}");
    $logistik = $sql->findAll("select * from m_pendaki_logistik where m_pendaki_id = {$id}");
    $darurat = $sql->findAll("select * from m_pendaki_darurat where m_pendaki_id = {$id}");
    $jml_anggota = count($anggota);

    $awal = tgl_indo(date("Y-m-d",$model->tgl_naik));
    $akhir = tgl_indo(date("Y-m-d",$model->tgl_turun));
    $timeDiff = abs($model->tgl_turun - $model->tgl_naik);
    $numberDays = $timeDiff/86400;
    $numberDays = intval($numberDays);
    
    
    $tulisan = "Nomor Register : ".$model->register.
                "\n".
                "Jalur Pendakian : ".$model->jalur_pendakian.
                "\n".
                "Nama Ketua : " .$model->nama;

    $dompdf = new \Dompdf\Dompdf();
    $qrCode = new Endroid\QrCode\QrCode($tulisan);
    $qrCode->setSize(300);
    $folder = "temp/";
    $qrCode->setWriterByName('png');
   
    $qrCode->setMargin(10);
    $qrCode->setEncoding('UTF-8');
    $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
    $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
    $qrCode->setLogoSize(150, 200);
    $qrCode->setRoundBlockSize(true);
    $qrCode->setValidateResult(false);
    $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);
    // header('Content-Type: '.$qrCode->getContentType());
   
    $qrCode->writeFile($folder.$model->id.'.png');
     
    
 
    ob_start();
    require('surat.php');
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);
    

    $dompdf->setPaper('F4', 'potrait');
    $dompdf->render();
    $output = $dompdf->output();
   
    file_put_contents('temp/'.$model->id.'.pdf', $output);
    
  
    chmod("/home/radensoe/public_html/temp/".$model->id.".pdf", 0777);
  
    try {
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.radensoerjo-sipenerang.or.id';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'admin@radensoerjo-sipenerang.or.id';                     // SMTP username
    $mail->Password   = 'Bismillah2019*';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;  
    
    //Recipients
    $mail->setFrom('admin@radensoerjo-sipenerang.or.id', 'TAHURA R SOERJO');
    $mail->addAddress($model->email, 'Dear Pendaki');
    $mail->addAttachment('/home/radensoe/public_html/temp/'.$model->id.'.pdf');         // Add attachment

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'SURAT IJIN KHUSUS PENDAKIAN GUNUNG DI KAWASAN TAHURA R. SOERJO ';
    $mail->Body    = 'Hai Sobat gunung, Data mu telah diverifikasi dan disetujui oleh tim kami
                      <br>
                      Berikut Kami cantumkan surat izin pendakian yang nanti harus kamu bawa saat melakukan pendakian
                        ';
    
    $mail->send();

   
    $data['is_approve'] = 1;
    $data['approve_by'] = $_SESSION['user']['id'];
    $update = $sql->update('m_pendaki', $data, array('id' => $id));

    echo json_encode(array('status' => 1, 'message' => "Email Terkirim" ), JSON_PRETTY_PRINT);
    
    } catch (Exception $e) {
        
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => "Email tidak terikirim"), JSON_PRETTY_PRINT);

    }

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

    // print_r($model);
    // exit();
//    $approve_by->nama = "A";
   foreach ($model as $key => $value){
       $province = $sql->find("select * from provinces where id = {$value->provinsi}");
       $kabkot = $sql->find("select * from regencies where id = {$value->kabkot}");
       $kecamatan = $sql->find("select * from districts where id = {$value->kecamatan}");
       $deskel = $sql->find("select * from villages where id = {$value->deskel}");
       $approve_by = $sql->find("select * from m_user where id = ($value->approve_by)");
       $approve_naik_by = $sql->find("select * from m_user where id = ($value->approve_naik_by)");
       $approve_turun_by = $sql->find("select * from m_user where id = ($value->approve_turun_by)");

       $model[$key] = (array) $value;
       $model[$key]['tgl_naik'] = tgl_indo(date("Y-m-d",$value->tgl_naik));
       $model[$key]['tgl_turun'] = tgl_indo(date("Y-m-d",$value->tgl_turun));
       $model[$key]['tanggal_lahir'] = tgl_indo(date("Y-m-d",$value->tgl_lahir));
       $model[$key]['provinsi'] = $province->name;
       $model[$key]['kabkot'] = $kabkot->name;
       $model[$key]['kecamatan'] = $kecamatan->name;
       $model[$key]['deskel'] = $deskel->name;
       $model[$key]['approve_by'] = isset($approve_by->nama)? $approve_by->nama : "";
       $model[$key]['approve_naik_by'] = isset($approve_naik_by->nama)? $approve_naik_by->nama : "";
       $model[$key]['approve_turun_by'] = isset($approve_turun_by->nama)? $approve_turun_by->nama : "";
   }
    $totalItem = $sql->count();
    $sql->clearQuery();

    if (!empty($model)) {
        echo json_encode(array('status' => 1, 'data' => array_filter($model), 'totalItems' => $totalItem), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => ""), JSON_PRETTY_PRINT);
    }
});


post('/pendaki/naik', function() {


 check_access(array('login' => true));
 $params = json_decode(file_get_contents("php://input"), true);


 unset($params['provinsi']);
 unset($params['kabkot']);
 unset($params['kecamatan']);
 unset($params['deskel']);
 unset($params['tgl_naik']);
 unset($params['tgl_turun']);
 unset($params['approve_by']);
 $sql = new LandaDb();
 $params['approve_naik_by'] = $_SESSION['user']['id'];
 $model = $sql->update('m_pendaki', $params, array('id' => $params['id']));


 echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);


});

post('/pendaki/turun', function() {


 check_access(array('login' => true));
 $params = json_decode(file_get_contents("php://input"), true);

 $sql = new LandaDb();
    unset($params['provinsi']);
    unset($params['kabkot']);
    unset($params['kecamatan']);
    unset($params['deskel']);
    unset($params['tgl_naik']);
    unset($params['tgl_turun']);
    unset($params['approve_by']);
    unset($params['approve_naik_by']);

    $params['approve_turun_by'] = $_SESSION['user']['id'];



 $model = $sql->update('m_pendaki', $params, array('id' => $params['id']));


 echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);


});

