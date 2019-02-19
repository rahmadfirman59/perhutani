<div id="list-blog" class="row" style="margin-right: 0px; margin-left: 0px;">
    <?php
    if (empty($list)) {
        echo '<blockquote class="quote-1">Mohon maaf, tidak ditemukan artikel pada kategori <b>' . ucfirst($kategori) . '</b>.</blockquote>';
    } else {
        foreach ($list as $val) {
            ?>
            <div class="item-blog item-blog blog-image-right">
                <div class="blog-feature-warp">
                    <a href="<?= url('d/' . $val->alias) ?>">
                        <?= get_first_image($val->content, 'medium') ?>
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
                        <div class="blog-text">
                            <a href="<?= url('d/' . $val->alias) ?>">
                                <h4 class="hover-text-theme" style="font-weight: bold"><?= $val->title ?></h4>
                            </a>
                            <p><?= cuplikan($val->content, 350) ?></p>
                        </div>
                    </div>
                    <div class='blog-footer-2 border-color-theme'>
                        <ul>
                            <li><i class="glyphicon glyphicon-user"></i> <a href="#" class="hover-text-theme"><?= $val->user ?></a></li>
                            <li><i class="glyphicon glyphicon-tag"></i> On <a href="<?= url('c/' . $val->kategori_alias) ?>" class="hover-text-theme"><?= $val->kategori ?></a></li>
                        </ul>

                        <a href="<?= url('d/' . $val->alias) ?>" class="btn btn-primary btn-sm" style="margin-top: -2px;padding: 0px 10px;float: right;color: #ffffff">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<div id="blog-pagination">
    <?php
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $url = site_url() . 'c/' . $kategori . '.html';
    echo pagination($count, $show, $currentPage, $url);
    ?>
</div>
