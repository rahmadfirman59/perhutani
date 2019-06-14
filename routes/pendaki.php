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
    header('Content-Type: '.$qrCode->getContentType());
    $qrCode->writeFile($folder.$model->id.'.png');
    ob_start();
    require('surat.php');
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('F4', 'potrait');
    $dompdf->render();
    $output = $dompdf->output();
    // $dompdf->stream("Surat Pendaki", array("Attachment"=>0));
    // exit();
    file_put_contents('temp/'.$model->id.'.pdf', $output);
    exit();

    try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ahmadgopurr59@gmail.com';                     // SMTP username
    $mail->Password   = 'm4db4LL12345';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ahmadgopurr59@gmail.com', 'TAHURA R SOERJO');
    $mail->addAddress($model->email, 'Dear Pendaki');
    $mail->addAttachment('/xampp/htdocs/perhutani/temp/'.$model->id.'.pdf');         // Add attachments
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'SURAT IJIN KHUSUS PENDAKIAN GUNUNG DI KAWASAN TAHURA R. SOERJO ';
    $mail->Body    = 'Hai Sobat gunung, Data mu telah diverifikasi dan disetujui oleh tim kami
                      <br>
                      Berikut Kami cantumkan surat izin pendakian yang nanti harus kamu bawa saat melakukan pendakian
                        ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

    // print_r("ok");
    // exit();

    $data['is_approve'] = 1;
    $update = $sql->update('m_pendaki', $data, array('id' => $id));

    echo json_encode(array('status' => 1, 'message' => "Email Terkirim" ), JSON_PRETTY_PRINT);
    // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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

   foreach ($model as $key => $value){
       $province = $sql->find("select * from provinces where id = {$value->provinsi}");
       $kabkot = $sql->find("select * from regencies where id = {$value->kabkot}");
       $kecamatan = $sql->find("select * from districts where id = {$value->kecamatan}");
       $deskel = $sql->find("select * from villages where id = {$value->deskel}");
    //    print_r($kabkot);
    //    exit();
       $model[$key] = (array) $value;
       $model[$key]['tgl_naik'] = tgl_indo(date("Y-m-d",$value->tgl_naik));
       $model[$key]['tgl_turun'] = tgl_indo(date("Y-m-d",$value->tgl_turun));
       $model[$key]['tanggal_lahir'] = tgl_indo(date("Y-m-d",$value->tgl_lahir));
       $model[$key]['provinsi'] = $province->name;
       $model[$key]['kabkot'] = $kabkot->name;
       $model[$key]['kecamatan'] = $kecamatan->name;
       $model[$key]['deskel'] = $deskel->name;
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
 $sql = new LandaDb();


 $awal = strtotime($params['tgl_naik']);
 $akhir = strtotime($params['tgl_turun']);
 $params['tgl_naik'] = $awal;
 $params['tgl_turun'] = $akhir;
 $model = $sql->update('m_pendaki', $params, array('id' => $params['id']));


 echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);


});

post('/pendaki/turun', function() {


 check_access(array('login' => true));
 $params = json_decode(file_get_contents("php://input"), true);
 $sql = new LandaDb();
 unset($params['provinsi']);
 unset($params['kabkot']);



 $awal = strtotime($params['tgl_naik']);
 $akhir = strtotime($params['tgl_turun']);
 $params['tgl_naik'] = $awal;
 $params['tgl_turun'] = $akhir;
 $model = $sql->update('m_pendaki', $params, array('id' => $params['id']));


 echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);


});
