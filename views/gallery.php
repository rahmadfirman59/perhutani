<div class="iconbox main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="subheader-single">
                    <section id="subheader" class="no-padding sub-header-border">
                        <div class="container">
                            <div class="row">
                                <div class="sub-header-warp">
                                    <h3 class="title-subheader">Foto Glintung Go Green</h3>
                                    <ol class="breadcrumb">
                                        <li><a href="<?= site_url() ?>">Home</a></li>
                                        <li>Foto</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="container gallery-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div id="list-blog" class="list-blog-warp">
                            <div class="gallery-item element-from-bottom isotope">
                                <ul class="first">
                                    <?php
                                    if (!empty($foto)) {
                                        foreach ($foto as $val) {
                                            ?>
                                            <li class="gallery-cover col-md-3">
                                                <a href="<?= url('g/' . $val->alias) ?>">

                                                    <?php
                                                    $a = str_replace("http", "https", get_first_image($val->content, 'mdium'));
                                                    echo $a;
                                                    ?>
                                                </a>
                                                <a href="<?= url('g/' . $val->alias) ?>">
                                                    <h5 class="text-cover" style="text-align: center"><?= $val->title ?></h5>
                                                </a>
                                                <p><?= $val->description ?></p>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        echo '<blockquote class="quote-1">Mohon maaf, tidak ditemukan artikel pada kategori <b>' . ucfirst($kategori) . '</b>.</blockquote>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>