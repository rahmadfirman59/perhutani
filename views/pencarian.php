<div id="list-blog" class="list-blog-warp">
    <?php
    if (empty($list)) {
        echo '<blockquote class="quote-1">Mohon maaf, tidak ditemukan artikel dengan kata kunci <b>' . $_GET['q'] . '</b>.</blockquote>';
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
                                <h4 class="hover-text-theme"><?= $val->title ?></h4>
                            </a>
                            <p><?= cuplikan($val->content, 200) ?></p>
                            <a href="<?= url('d/' . $val->alias) ?>" class="readmore hover-text-theme">[read more]</a>
                        </div>
                    </div>
                    <div class='blog-footer-2 border-color-theme'>
                        <ul>
                            <li><i class="glyphicon glyphicon-user"></i> Posted by <a href="#" class="hover-text-theme"><?= $val->user ?></a></li>
                            <li><i class="glyphicon glyphicon-tags"></i> On <a href="<?= url('c/' . $val->kategori_alias) ?>" class="hover-text-theme"><?= $val->kategori ?></a></li>
                        </ul>
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
    $url = site_url();
    echo pagination($count, $show, $currentPage, $url);
    ?>
</div>