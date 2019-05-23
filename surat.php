

<html>
<head>
  <title>PDF Create</title>
</head>
<!-- <body background="app/img/jatim.png"> -->
<body >
<!-- <body  style="background: url(app/img/system/gray-bg.png);background-repeat: no-repeat;80px 90px;"> -->
    <table style="margin-top:0px; width: 100%">
        <tr>
            <td style="text-align: center;">
                <img src="app/img/tahura.jpg" width="50" height="80" />
            </td>
            <td style="text-align: center;">
                <span style="font-size: 12px;">
                    <b>
                        PEMERINTAH PROVINSI JAWA TIMUR
                    </b>

                </span>
                <br/>
                <span style="font-size: 14px">
                    <b>
                        DINAS KEHUTANAN
                    </b>
                </span>
                <br/>
                <span style="font-size: 14px">
                    <b>
                        UPT TAMAN HUTAN RAYA (TAHURA) R. SOERJO
                    </b>
                </span>
                <br />
                <span style="font-size: 12px">
                    <!-- <b> -->
                        Alamat : JL. Simpang Panji Suroso Kav. 144 Telp. / Fax. 0341 – 483254
                    <!-- </b> -->
                </span>
                <br/>
                <span style="font-size: 12px">
                    <b>
                        MALANG
                    </b>
                </span>
                <br/>

                <br/>
            </td>
            <td>
                <img src="temp/<?= $model->id ?>.png" width="50" height="50" />
            </td>
        </tr>
    </table>
    <!-- <hr class="garis1"/> -->
    <hr class="garis2"/>
    <p style="font-size: 14px; text-align: center;">
        <b>
          SURAT IJIN KHUSUS PENDAKIAN GUNUNG DI KAWASAN TAHURA R. SOERJO
            </br>
        </b>

    </p>
    <p style="font-size: 12px; text-align: center; padding: 1px;">
            Nomor Karcis : .......................s/d...........................
        <br />
            Nomor Register : <?php echo $model->register?> Tanggal <?php echo date("d m Y")?>
    </p>

    <table style="width: 100%;  font-size:12px;">
      <tr >
        <td style="text-align:center;">
          Berdasarkan&nbsp;&nbsp;&nbsp;:
        </td>
        <td>
          	1.	Pasal 31 Undang-Undang Nomor 5 Tahun 1990 tentang Konservasi Sumber Daya Alam Hayati dan Ekosistemnya;
        </td>
      </tr>
      <tr>
        <td>
        </td>
        <td>
          	2.	Peraturan Daerah Provinsi Jawa Timur Nomor 2 Tahun 2013 tentang Pengelolaan Taman Hutan Raya R. SOERJO.
        </td>
      </tr>
    </table>
    <p style="font-size: 12px; text-align: left;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Memberikan ijin kepada :
    </p>
    <table style="margin-left: 20px;font-size:12px;">
      <tr >
        <td>
          <b>
          Nama Lengkap (Ketua Regu)
          </b>
        </td>
        <td>
          <?= $model->nama ?>
        </td>
      </tr>
      <tr>
        <td >
          <b>
            Alamat Lengkap
          </b>
        </td>
        <td>
          <?= $model->alamat ?>
        </td>
      </tr>
      <tr>
        <td >
          <b>
            Kebangsaan
          </b>
        </td>
        <td>
          <?= $model->kewarganegaraan ?>
        </td>
      </tr>
      <tr>
        <td >
          <b>
            Jumlah Personel
          </b>
        </td>
        <td>
          <?= $jml_anggota   ?>
        </td>
      </tr>
    </table>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td>
          Memasuki Kawasan Tahura R. SOERJO untuk melakukan pendakian Gunung Arjuna mulai tanggal <b> <?= $awal?> </b> s/d <b> <?= $akhir?> </b>  selama <b> <?= $numberDays ?> </b> hari, dengan ketentuan sebagai berikut :
        </td>
      </tr>
    </table>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          1
        </td>
        <td>
          Pendaki usia kurang dari 17 tahun harus menyerahkan surat ijin dari orangtua/wali dilampiri fotocopy KTP orangtua/wali
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          2
        </td>
        <td>
          Pendaki (Ketua dan Anggota) wajib menyerahkan kartu identitas / fotocopy identitas (KTP/SIM/KTM/Kartu Pelajar) yang masih berlaku kepada Petugas di Pos Ijin Pendakian;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          3
        </td>
        <td>
          Pendaki wajib mengisi daftar/List perlengkapan yang dibawa sebagaimana blanko isian terlampir;
        </td>
      </tr>
      <tr>
        <td td style="vertical-align:top;  font-weight: bold;">
          4
        </td>
        <td>
          Mematuhi dan membayar Retribusi Masuk Kawasan Tahura R. SOERJO dan Asuransi sejumlah personil sesuai peraturan perundang-undangan yang berlaku dan pastikan Bukti Retribusi/Karcis adalah Karcis Resmi yang dikeluarkan oleh UPT Tahura R. SOERJO dan Karcis Asuransi oleh PT. JASA RAHARJA sesuai dengan jumlah personil serta menyimpan bukti retribusi tersebut;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          5
        </td>
        <td>
          Pada saat melakukan pendakian agar berjalan secara berkelompok, tidak memisahkan diri dari kelompok/ rombongan; berjalan sesuai jalur yang telah ditetapkan dan <b>dilarang</b> untuk membuat/memotong jalur;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          6
        </td>
        <td>
          <b>Dilarang</b> melakukan tindakan yang mengakibatkan kerusakan flora/fauna, melakukan coretan-coretan/ vandalisme pada benda-benda, pohon, bebatuan dan atau bangunan di dalam kawasan;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          7
        </td>
        <td>
          <b>Dilarang</b> memaksakan diri untuk melanjutkan perjalanan jika situasi dan kondisi tidak memungkinkan (kesehatan, cuaca, keamanan dll);
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top;  font-weight: bold;">
          8
        </td>
        <td>
          <b>Dilarang</b> melanggar norma-norma susila, nilai-nilai adat-istiadat masyarakat setempat;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          9
        </td>
        <td>
          <b>Dilarang</b> membawa, menggunakan minuman keras dan obat-obatan terlarang (narkoba);
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top;  font-weight: bold;">
          10
        </td>
        <td>
          <b>Dilarang</b> membuang sampah sembarangan dan bawalah sampah anda turun kembali (bungkus/kaleng bekas makanan, botol/kaleng bekas minuman dan sejenisnya) serta wajib menjaga kebersihan dan keamanan kawasan;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top;  font-weight: bold;">
          11
        </td>
        <td>
        Menjaga keselamatan kelompok dan sesama pengunjung/pendaki;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          12
        </td>
        <td>
        Turut berpartisipasi dalam upaya Pencegahan, Pengendalian dan Penanggulangan Bencana Alam, dan memastikan bahwa tempat yang ditinggalkan tidak terdapat api/bara api;
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top; font-weight: bold;">
          13
        </td>
        <td>
          Segala bentuk pelanggaran yang menyalahi peraturan akan dikenakan Sanksi sesuai peraturan perundang-undangan yang berlaku.
        </td>
      </tr>
    </table>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td>
          Demikian Surat Ijin ini diberikan untuk dilaksanakan dan dipatuhi dengan penuh tanggung jawab
        </td>
      </tr>
    </table>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td style="text-align:center;">
          <b>Penerima/Pemegang Surat Ijin</b>
        </td>
        <td>
          &nbsp;
        </td>
        <td style="text-align:center;">
          <b>Petugas Pos Pendakian <?= $model->jalur_pendakian?> </b>
        </td>
      </tr>
      <tr>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
      </tr>
      <!-- <tr>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
      </tr> -->

      <tr>
        <td style="text-align:center;">
          <?= $model->nama;?>
        </td>
        <td>
          &nbsp;
        </td>
        <td style="text-align:center;">
          ............
          <br>
          NIP .
        </td>
      </tr>
    </table>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr style="text-align:center;">
        <td>
          Mengetahui
          <br>
          PENGAWAS LAPANGAN ..........................
        </td>
      </tr>
      <tr style="text-align:center;">
        <td>
          &nbsp;
        </td>
      </tr>
      <tr style="text-align:center;">
        <td>
          .......
          <br>
          NIP.
        </td>
      </tr>
    </table>
    <br />
    <table  style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr style="vertical-align:top;">
        <td>
          Lampiran
        </td>
        <td>
          Surat Ijin Khusus Pendakian Gunung Di Kawasan Tahura R. SOERJO
        </td>
        <td rowspan="3">
        <img src="temp/<?= $model->id ?>.png" width="50" height="50" />
        </td>
      </tr>
      
      <tr style="vertical-align:top;">
        <td>
        No. Register
        </td>
        <td>
          <?= $model->register ?>
        </td>
        <!-- <td>
          <?= $model->register ?>
        </td> -->
      </tr>
      

    </table>
    <br />
    <p style="width: 100%;margin-left: 20px;font-weight: bold;font-size:12px;">I. DAFTAR NAMA PENDAKI</p>
    <table border="1" style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <th>
          No.
        </th>
        <th>
          Nama
        </th>
        <th>
        No Identitas
        </th>
        <th>
         L / P
        </th>
        <th>
        Keterangan Kesehatan
        </th>
      </tr>
      <?php foreach ($anggota as $key => $ang): ?>
        <tr>
          <td>
           <?= $key + 1?>
          </td>
          <td>
           <?= $ang->nama?>
          </td>
          <td>
            <?= $ang->no_identitas?>
          </td>
          <td>
            <?= $ang->kelamin?>
          </td>
          <td>

          </td>
        </tr>
      <?php endforeach; ?>

    </table>
    <br />
    <p style="width: 100%;margin-left: 20px;font-weight: bold;font-size:12px;">II. Nama, Alamat  dan Nomor Telepon/HP yang dapat dihubungi dalam keadaan Darurat </p>
    <table border="1" style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <th>
          No.
        </th>
        <th>
          Nama
        </th>
        <th>
        Nomor Tlp/HP yang dapat dihubungi
        </th>
        <th>
        Alamat
        </th>
        <th>
        Hubungan Keluarga
        </th>
      </tr>
      <?php foreach ($darurat as $key => $dar): ?>
        <tr>
          <td>
           <?= $key + 1?>
          </td>
          <td>
           <?= $dar->nama?>
          </td>
          <td>
            <?= $dar->no_hp?>
          </td>
          <td>
            <?= $dar->alamat?>
          </td>
          <td>
              <?= $dar->hubungan?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br />
    <p style="width: 100%;margin-left: 20px;font-weight: bold;font-size:12px;">III. DAFTAR PERLENGKAPAN DAN LOGISTIK YANG DIBAWA  </p>

    <table border="1"  style=" float:left;width:45%; margin-left: 20px;font-size:12px;">
    <tbody>
      <tr>
        <th > Peralatan Standart</th>
        <th> Jumlah (Satuan)</th>
      </tr>
    <tr>
      <td> Tenda</td>
      <td> <?= $perlengkapan->tenda?></td>
    </tr>
    <tr>
      <td> Sleeping Bag/Kantong Tidur</td>
      <td> <?= $perlengkapan->kantung_tidur?></td>
    </tr>
    <tr>
      <td> Peralatan Masak+Bahan Bakar</td>
      <td> <?= $perlengkapan->masak_bakar?></td>
    </tr>
    <tr>
      <td> Ponco / Jas Hujan</td>
      <td> <?= $perlengkapan->ponco?></td>
    </tr>
    <tr>
      <td> Senter, Alat Penerangan (sejenisnya)</td>
      <td> <?= $perlengkapan->penerangan?></td>
    </tr>
    <tr>
      <td> Obat-obatan pribadi dan P3K</td>
      <td> <?= $perlengkapan->p3k?></td>
    </tr>
    <tr>
      <td> Matras/alas tidur (sejenisnya)</td>
      <td> <?= $perlengkapan->matras?></td>
    </tr>
    <tr>
      <td>Kantong sampah</td>
      <td> <?= $perlengkapan->sampah?></td>
    </tr>
    <tr>
      <td> Jaket</td>
      <td> <?= $perlengkapan->jaket?></td>
    </tr>
    </tbody>
    </table>
    <table border="0"  style=" float:left;width:2%;">
    <tbody>
    </tbody>
    </table>

    <table border="1"  style=" float:left;width:45%;margin-left: 20px;font-size:12px;">
    <tbody>
      <tr>
        <th > Makanan dan Minuman (Logistik)</th>
        <th> Jumlah (Satuan)</th>
      </tr>
      <?php foreach ($logistik as $log) :?>
        <tr>
         <td><?= $log->nama?></td>
         <td><?= $log->jumlah?></td>
       </tr>
      <?php endforeach ?>
    </tbody>
    </table>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />


    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td style="text-align:center;">
          <b>Telah di Cek oleh :</b>
        </td>
        <td>
          &nbsp;
        </td>
        <td style="text-align:center;">
          <b><?= date("d M Y") ?></b>
        </td>
      </tr>
      <tr>
        <td style="text-align:center;">
          Petugas Pos Pendakian Tahura R. SOERJO
        </td>
        <td>
          &nbsp;
        </td>
        <td style="text-align:center;">
        Penerima/Pemegang Surat Ijin,
        </td>
      </tr>
      <tr>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          &nbsp;
        </td>
      </tr>

      <tr>
        <td style="text-align:center;">
          ............
        </td>
        <td>
          &nbsp;
        </td>
        <td style="text-align:center;">
          <?= $model->nama;?>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <table style="width: 100%;margin-left: 20px;font-size:12px;">
      <tr>
        <td>
          Catatan :
        </td>
      </tr>
      <tr>
        <td>
          1. Pendaki wajib membayar restribusi kawasan
        </td>
      </tr>
      <tr>
        <td>
          2. Pendaki wajib melaporkan diri saat turun
        </td>
      </tr>
      <tr>
        <td>
          3. Membawa dan menyerah kembali sampah yg di hasilkan  ke pos penjagaan
        </td>
      </tr>

      <tr>
        <td>

        </td>
      </tr>
      <tr>
        <td>
          Biaya
        </td>
      </tr>
      <tr>
        <td>
          WNI : Rp 10,200 /orang /hari
        </td>
      </tr>
      <tr>
        <td>
          WNA : Rp 25.200 / orang /hari
        </td>
      </tr>

    </table>



</body>
</html>
