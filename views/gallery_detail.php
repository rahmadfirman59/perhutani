<div class="iconbox main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="subheader-single">
                    <section id="subheader" class="no-padding sub-header-border">
                        <div class="sub-header-warp">
                            <h1 class="title-subheader"><?= $title ?></h1>
                            <ol class="breadcrumb">
                                <li><a href="<?= site_url() ?>">Home</a></li>
                                <li><a href="<?= url('gallery') ?>">Foto</a></li>
                                <li><?= $title ?></li>
                            </ol>
                        </div>
                    </section>
                </div>
            </div>
            <div class="container gallery-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div id="list-blog" class="list-blog-warp">
                            <div class="gallery-item element-from-bottom isotope">
                                <ul class="gallery" style="list-style: none;">
                                    <?php
                                    $img = get_gallery_src($foto->content);
                                    if (!empty($img)) {
                                        foreach ($img as $val) {
                                            $small = str_replace('-700x700-', '-350x350-', $val);
                                            $small = str_replace('http', 'https', $small);
                                            ?>
                                            <li class="col-md-3">
                                                <img src="<?= $small ?>" data-bsp-large-src="<?= $val ?>">
                                            </li>
                                            <?php
                                        }
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