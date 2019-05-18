

<html>
<head>
  <title>Laporan Pendaki Masuk</title>
</head>
<!-- <body background="app/img/jatim.png"> -->
<body >
  <div class="panel panel-default" ng-show="is_tampil" id="laporan">
    <div class="panel-body">
      <div class="table-responsive">

        <table  style="margin-top:0px; width: 100%" >
          <tr>
            <td>
              <!-- <img src="{{ logo }}" align="left" width="146" height="105"/> -->
            </td>
            <td style="text-align: center">
              <h2 style="margin: 0px ;text-transform: uppercase;">
                LAPORAN PENDAKI MASUK<br/>
              </h2>

              <br/>
            </td>
            <td>
              <!-- <img src="img/white.png" align="left" width="146" height="105"> -->
            </td>
          </tr>
        </table>
        <table border="1" class="table  table-bordered table-striped">
          <tr>
            <th style="text-align: center;"> No </th>
            <th style="text-align: center;"> Nama </th>
            <th style="text-align: center;"> Email </th>
            <th style="text-align: center;"> Tanggal Daftar </th>
            <th style="text-align: center;"> Tanggal Naik </th>
            <th style="text-align: center;"> Tanggal Turun </th>
            <th style="text-align: center;"> Jalur Pendakian </th>
            <th style="text-align: center;"> Anggota </th>
          </tr>

          <?php foreach ($params as $key => $value) { ?>
            <tr >
              <td class="text-center"><?php echo $key + 1 ?></td>
              <td><?php echo $value['nama'] ?></td>

              <td><?php echo $value['email'] ?></td>

              <td><?php echo $value['tgl_daftar'] ?></td>

              <td><?php echo $value['tgl_naik'] ?></td>

              <td><?php echo $value['tgl_turun'] ?></td>

              <td><?php echo $value['jalur_pendakian'] ?></td>

              <td><?php echo $value['jml_anggota'] ?></td>
            </tr>
          <?php  } ?>
          <!--

        </table>
      </div>
    </div>
  </div>



</body>
</html>
