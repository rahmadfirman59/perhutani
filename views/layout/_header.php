<!--<div class="top-bar">
    <div class="top-bar-inner">
        <ul class="top-bar-info">
            <?php
            if (!empty($setting->email)) {
                echo '<li><a href="#">Email : ' . $setting->email . '</a></li>';
            }
            if (!empty($setting->telepon)) {
                echo '<li><a href="#">Telepon : ' . $setting->telepon . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>-->
<header class="header" id="page-header">
    <div class="header-inner">
        <div class="logo">
            <a href="<?=site_url()?>" title="<?=$setting->nama?>">
              <img src="<?=site_url()?>app/img/system/logobaru.png">
              <!-- <img src="<?=site_url()?>app/img/system/logo.png"></a> -->
        </div>
        <div class="logo-sm">
            <a href="<?=site_url()?>" title="<?=$setting->nama?>"><img src="<?=site_url()?>app/img/system/tulisan.png">a</a>
        </div>
        <div id="btn-navbar">
            <button type="button" id="menu-mobile" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                <span class="glyphicon glyphicon-align-justify"></span>
            </button>
        </div>
        <div class="navi">
            <ul class="navi-level-1">
                <li>
                    <a href="<?= url('profil') ?>" class="dark-text">Profil</a>
                </li>
                <!-- <li>
                    <a href="<?= url('c/berita') ?>" class="dark-text">Berita</a>
                </li> -->
                <li>
                    <a href="<?= url('c/pengumuman') ?>" class="dark-text">Pengumuman</a>
                </li>

<!--                <li>-->
<!--                    <a href="#" class="dark-text has-sub">Pengumuman</a>-->
<!--                    <ul class="navi-level-2">-->
<!--                        <li>-->
<!--                            <a href="--><?//= url('c/pengumuman') ?><!--">Pengumuman</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?//= url('c/barang') ?><!--">Barang</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li>
                    <a href="<?= site_url().'formulir' ?>" class="dark-text">Registrasi Pendakian</a>
                </li>
                <!-- <li>
                    <a href="<?= site_url().'gallery' ?>" class="dark-text">SOP PENDAKIAN</a>
                </li> -->
                <li>
                    <a href="<?= url('sop') ?>" class="dark-text">SOP PENDAKIAN</a>
                </li>
                <!-- <li>
                    <a href="<?= site_url().'c/gallery' ?>" class="dark-text">JALUR PENDAKIAN </a>
                </li> -->
                <!-- <li>
                    <a href="#" class="btn-search-navi color-theme border-color-theme bg-hover-theme">
                        <i class="glyphicon glyphicon-search search" aria-hidden="true"></i>
                    </a>
                    <div class="search-popup">
                        <form class="form-search-navi" action="<?= url("search") ?>">
                            <div class="input-group">
                                <input class="form-control" name="q" style="width: 250px;" placeholder="Masukkan Kata Kunci" type="text">
                            </div>
                        </form>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
</header>
