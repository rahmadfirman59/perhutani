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
    $mail = new PHPMailer(true);





    $kode = generateKode();
    $model = $sql->find("select * from m_pendaki where id = {$id}");
    $anggota = $sql->findAll("select * from m_pendaki_anggota where m_pendaki_id = {$id}");
    $perlengkapan = $sql->find("select * from m_pendaki_perlengkapan where m_pendaki_id = {$id}");
    $logistik = $sql->findAll("select * from m_pendaki_logistik where m_pendaki_id = {$id}");
    $darurat = $sql->findAll("select * from m_pendaki_darurat where m_pendaki_id = {$id}");
    $jml_anggota = count($anggota) + 1;
    $awal = date("j M Y",$model->tgl_naik);
    $akhir = date("j M Y",$model->tgl_turun);
    $timeDiff = abs($model->tgl_turun - $model->tgl_naik);
    $numberDays = $timeDiff/86400;
    $numberDays = intval($numberDays);
    $dompdf = new \Dompdf\Dompdf();
    $qrCode = new Endroid\QrCode\QrCode($model->register);
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
    // Directly output the QR code
    header('Content-Type: '.$qrCode->getContentType());
    $qrCode->writeFile($folder.$model->id.'.png');
    ob_start();
    require('test.php');
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $output = $dompdf->output();
    // $dompdf->stream("Webslesson", array("Attachment"=>0));
    file_put_contents('temp/'.$model->id.'.pdf', $output);

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
    $mail->addAddress('jibunwahyudi@gmail.com', 'Dear Pendaki');
    $mail->addAttachment('/var/www/html/perhutani/temp/'.$model->id.'.pdf');         // Add attachments
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'SURAT IJIN KHUSUS PENDAKIAN GUNUNG DI KAWASAN TAHURA R. SOERJO ';
    $mail->Body    = 'Hai Sobat gunung, Data mu telah diverifikasi dan disetujui oleh tim kami
                      <br>
                      Berikut Kami cantumkan surat izin pendakian yang nanti harus kamu bawa saat melakukan pendakian
                        ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
