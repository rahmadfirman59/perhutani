<footer class="footer iconbox">
    <div class="container ">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 footer-item footer-about">
                <div class="title-wrap">
                    <h3 class="title-inline" style="margin-top:0px;">Pendakian Arjuno</h3>
                </div>
                <p class="text-about">
                    <?= $setting->deskripsi ?>
                </p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 footer-item">
                <div class="title-wrap">
                    <h3 class="title-inline" style="margin-top:0px;">Kategori</h3>
                </div>
                <ul class="category-footer">
                    <?php
                    $sql = new LandaDb();
                    $select = $sql->findAll("select * from m_kategori where id in (5,14)");
                    foreach ($select as $val) {
                        echo '<li><a href="' . url('c/' . $val->alias) . '" class="btn btn-default">' . $val->name . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 footer-item">
                <div class="title-wrap">
                    <h3 class="title-inline" style="margin-top:0px;">Ikuti Kami</h3>
                </div>
                <ul class="category-footer">
                    <li><a href="<?= $setting->instagram ?>" class="btn btn-warning" target="_blank"><img style="width: 12px" src="<?= site_url() ?>/app/img/icon/instagram.png"> Instagram</a></li>
                    <li><a href="<?= $setting->facebook ?>" class="btn btn-primary" target="_blank"><img style="width: 12px" src="<?= site_url() ?>/app/img/icon/facebook.png"> Facebook</a></li>
                    <li><a href="<?= $setting->twitter ?>" class="btn btn-info" target="_blank"><img style="width: 12px" src="<?= site_url() ?>/app/img/icon/twiter.png"> Twitter</a></li>
                    <li><a href="<?= $setting->youtube ?>" class="btn btn-danger" target="_blank"><img style="width: 12px" src="<?= site_url() ?>/app/img/icon/youtube.png"> Youtube</a></li>
                </ul>
            </div>


            <div class="col-md-3 col-sm-3 col-xs-12 footer-item">
                <div class="title-wrap">
                    <h3 class="title-inline" style="margin-top:0px;">Kontak Kami</h3>
                </div>
                <div class="contact-f1" style="margin-left: -10px;margin-right: -10px;">
                    <table class="table table-borderless">
                        <tr>
                            <td style="min-width: 100px"><i class="glyphicon glyphicon-phone"></i> Telepon</td>
                            <td><?= $setting->telepon ?></td>
                        </tr>
                        <tr>
                            <td><i class="glyphicon glyphicon-envelope"></i> E-mail</td>
                            <td><?= $setting->email ?></td>
                        </tr>
                        <tr>
                            <td><i class="glyphicon glyphicon-home"></i> Alamat</td>
                            <td><?= $setting->alamat ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</footer>
<section class="no-padding" id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="warp-copyright visible-md visible-lg">
                        <p style="float: left">Pengunjung Website : &nbsp;</p>
                        <noscript><a href="http://www.supercounters.com/hitcounter">Pengunjung Website</a></noscript>
                        <script type="text/javascript" src="//widget.supercounters.com/ssl/hit.js">
                        </script>
                        <script type="text/javascript">sc_hit(1507357, 0, 5);</script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="warp-copyright">
                    <p class="text-copyright">
                        © Copyright 2018. <a href="#"><?= $setting->nama; ?></a>. All right reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
