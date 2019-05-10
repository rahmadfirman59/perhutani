<section class="no-padding">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $directory = "app/img/slider";
            $images = glob($directory . "/*.{jpg,jpeg,png}", GLOB_BRACE);
            $first = true;
            foreach ($images as $key => $img) {
                $active = '';
                if ($first == true) {
                    $active = 'active';
                }

                echo '<li data-target="#carousel-example-generic" data-slide-to="' . $key . '" class="' . $active . '"></li>';
                $first = false;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $first = true;
            foreach ($images as $image) {
                ?>
                <div class="item <?= ($first == true) ? "active" : ""; ?>">
                    <img src="<?= site_url() . '' . $image ?>" alt="Glintung Go Green">
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">

                        </div>
                    </div>
                </div>
                <?php
                $first = false;
            }
            ?>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</section>
<section class="iconbox">
    <div class="container">
        <div class="row">
            <div class="iconbox-set-1-warp" style="margin-top: 10px">
                <div class="col-md-12 text-center des-text">
                    <h3 class="text-cap text-center page-header">Jalur Resmi Pendakian</h3>
                </div>
                <?php
                foreach ($visimisi as $vals) {
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 visi">
                        <div class="icon-image">
                          <a href="<?= url('jalur/' . $vals->alias) ?>">

                            <?php

                            $a = get_first_image($vals->content, 'medium');
                            echo $a;
                            ?>
                          </a>
                        </div>
                        <div class="iconbox iconbox-set-1">
                            <h4 class="text-up"><?= $vals->title ?>
                            </h4>
                            <i class="color-theme"><?= cuplikanvisi($vals->content, 600) ?></i>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</section>


<section class="iconbox no-padding-bottom">
    <div class="container">
        <div class="row" style="margin-top: 50px">
            <div class='col-md-8 col-sm-8 col-xs-12' style="margin-bottom: 20px;">
                <h3 class="text-cap title-header hr">Kabar Tahura</h3>
                <div id="list-blog" class="list-blog-warp">
                    <div class="row">
                        <?php
                        foreach ($terbaru as $val) {
                            ?>

                            <div class='col-md-6 col-sm-12 col-xs-12 terbaru'>
                                <div class="item-blog blog-single-feature-img">
                                    <div class="blog-feature-warp">
                                        <a href="<?= url('d/' . $val->alias) ?>">
                                            <?php
//                                            $a = str_replace("http", "https", get_first_image($val->content, 'medium'));
//                                            echo $a;
                                            echo get_first_image($val->content, 'medium');

                                            ?>
                                        </a>
                                    </div>
                                    <div class="blog-feature-content">
                                        <div class="blog-feature-content-inner">
                                            <div class="blog-data">
                                                <div class="date-time bg-theme">
                                                    <span class="date"><?= date("d", strtotime($val->date)) ?></span>
                                                    <span class="month"><?= date("M", strtotime($val->date)) ?></span>
                                                </div>
                                            </div>
                                            <div class='blog-text'>
                                                <a href='<?= url('d/' . $val->alias) ?>'>
                                                    <h4 style="font-weight: bold"><?= $val->title ?></h4>
                                                </a>
                                                <p><?= cuplikan($val->content, 150) ?></p>
                                            </div>
                                        </div>
                                        <div class='blog-footer-2 border-color-theme'>
                                            <ul>
                                                <li><i class="glyphicon glyphicon-user"></i> <a
                                                            href="<?= url('d/' . $val->alias) ?>"
                                                            class="hover-text-theme text-capitalize"><?= $val->user ?></a>
                                                </li>
                                                <li><i class="glyphicon glyphicon-tag"></i> On <a
                                                            href="<?= url('d/' . $val->alias) ?>"
                                                            class="hover-text-theme text-capitalize"><?= $val->kategori ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!--<a href='#' class='btn btn-success' style="width: calc(100% - 15px)">Selengkapnya</a>-->
            </div>
            <div class='col-md-4 col-sm-4 col-xs-12'>
                <h3 class="text-cap title-header hr">Berita Populer</h3>
                <div id="home-sidebar">
                    <div id='list-blog'>
                        <?php
                        foreach ($populer as $val) {
                            ?>
                            <div class="mobile_thumbnail" style="padding-top: 15px">
                                <div class="mobile_img">
                                    <a href="<?= url($val->alias) ?>">

                                        <?= get_first_image($val->content, 'small') ?>
                                    </a>
                                </div>
                                <div class="mobile_detail">
                                    <a href="<?= url('d/' . $val->alias) ?>">
                                        <h2><?= $val->title ?></h2>
                                    </a>
                                    <div class="post-labels">
                                        <span class="glyphicon glyphicon-calendar"
                                              style="margin:0"></span> <?= date("d-m-Y", strtotime($val->date)) ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="main-wraper padd-60 background-block"
     style="background-color: #006332;margin-top: -30px;padding-bottom: 70px">
<!--    <img class="center-image" src="themes/simple/images/component/event-bg.jpg" alt="background" style="display: none;">-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="second-title">
                    <h3 class="subtitle color-red-3 underline" style="color: #fff">PESONA WISATA</h3>
                    <!--                    <h2>What is happening now</h2>-->
                    <!--<p class="color-grey">Curabitur nunc erat, consequat in erat ut, congue bibendum nulla. Suspendisse id tor.</p>-->
                </div>
            </div>
        </div>

        <div class="row">
            <?php

            // $jumlah = count($pelatihan);

            foreach ($pelatihan as $val) {
                $g = get_first_image($val->content, 'big');
                ?>
                <div class="col-md-4">
                    <div class="hotel-item style-6">
                        <div class="radius-top" style="background-color: #808080;height: 226px;overflow: hidden;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                            <?= $g ?>
                        </div>
                        <div class="title" style="text-align: center;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
                            <h4><b><?= $val->title ?></b></h4>
<!--                            <div class="tour-info">-->
                                <!--                                <img alt="calender" src="themes/simple/images/component/calendar_icon_grey.png">-->
                                <!--                                <span class="font-style-2 color-grey-3">Jun <b>11th</b> 2018 TO Jul <b>15th</b> 2018</span>-->
<!--                            </div>-->

                            <!--                            <p></p>-->
<!--                            <div class="clearfix">-->
                                <a href="<?= url('d/' . $val->alias) ?>"
                                   class="c-button b-40 bg-red-3 hv-red-3-o">Lihat Selengkapnya</a>
<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>
<section class="iconbox" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="second-title">
                            <h3 class="subtitle color-red-3 underline">PENGHARGAAN YANG DIRAIH</h3>
                        </div>
                    </div>
                </div>
                <div class="partner-warp">
                    <div class="owl-carousel owl-carousel2 owl-theme owl-partner" style="margin: 5px">

                        <?php
                        $directory = "app/img/penghargaan";
                        $images = glob($directory . "/*.{jpg,png}", GLOB_BRACE);




                        foreach ($images as $key => $val) {


                            $name = str_replace("app/img/penghargaan/", "", $val);
                            $name = str_replace(".png", "", $name);
                            $name = str_replace(".jpg", "", $name);
//                            $name = urlParsing($name);
//                            print_r($name);
                            $name = str_replace("-", " ", $name);


                            echo '
                                <div class="mitra" >
                                        <div class=" " style="height: max-content;padding-top: 0px">
                                            <div  style="margin: 5px;padding: 0px;height: 135px;overflow: hidden">
                                                 <a href="' . site_url() . '' . $val . '" data-toggle="lightbox">
                                                    <img src="' . site_url() . '' . $val . '" class="img-fluid" alt="mitra 3g">
                                                </a>
                                            </div>
                                       </div>
                                    <h4 style="padding: 0px 15px">' . $name . '</h4>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="iconbox" style="margin-bottom: 50px;background-color: #fff">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="second-title">
                            <h3 class="subtitle color-red-3 underline">MITRA PENDAKIAN ARJUNO</h3>
                            <!--                    <h2>What is happening now</h2>-->
                            <!--<p class="color-grey">Curabitur nunc erat, consequat in erat ut, congue bibendum nulla. Suspendisse id tor.</p>-->
                        </div>
                    </div>
                </div>
                <div class="partner-warp" ng-click="">
                    <div class="owl-carousel owl-carousel2 owl-theme owl-partner" style="margin: 5px">

                        <?php
                        $directory = "app/img/mitra";
                        $images = glob($directory . "/*.{jpg,png}", GLOB_BRACE);


                        foreach ($images as $key => $val) {


                            $name = str_replace("app/img/mitra/", "", $val);
                            $name = str_replace(".png", "", $name);
                            $name = str_replace(".jpg", "", $name);
//                            $name = urlParsing($name);
//                            print_r($name);
                            $name = str_replace("-", " ", $name);


                            echo '
                                <div class="mitra" >
                                        <div class="square-box ">
                                            <div class="square-content thumbnail" style="margin: 5px">
                                                <img src="' . site_url() . '' . $val . '"   alt="mitra 3g">
                                            </div>
                                       </div>
                                    <h4>' . $name . '</h4>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
