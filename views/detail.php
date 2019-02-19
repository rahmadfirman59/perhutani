<div id="single-blog" class="single-blog-warp">
    <div class="blog-feature-warp">
        <div class="detail-pic">
            <?= get_first_image($artikel->content, 'big') ?>
        </div>
        <div style="margin-top: 25px;">
            <?= rmImg($artikel->content) ?>
        </div>
        <div class="row share-article">
            <p><b>Bagikan artikel ini di :</b></p>
            <div class="sosmed-kanan">
                <a class="share fb" href="http://www.facebook.com/sharer.php?u=<?= url('d/' . $artikel->alias) ?>"
                   onclick="window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=700,resizable=0,top=50,left=100&quot;);return false;"
                   target="_blank" title="Bagikan artikel ini di Facebook">
                    <span class=""> Facebook</span>
                </a>
                <a class="share tw"
                   href="https://twitter.com/intent/tweet?url=<?= url('d/' . $artikel->alias) ?>&amp;text=<?= $artikel->title ?>"
                   onclick="window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=700,resizable=0,top=50,left=100&quot;);return false;"
                   target="_blank" title="Bagikan artikel ini di Twitter">
                    <span class=""> Twitter</span>
                </a>
                <a class="share gplus" href="https://plus.google.com/share?url=<?= url('d/' . $artikel->alias) ?>"
                   onclick="window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=700,resizable=0,top=50,left=100&quot;);return false;"
                   target="_blank" title="Bagikan artikel ini di Google Plus">

                    <span class=""> Google Plus</span>
                </a>
            </div>
        </div>
    </div>
    <div class="blog-footer-2 border-color-theme">
        <ul>
            <li><i class="glyphicon glyphicon-user"></i> <a href="#" class="hover-text-theme"><?= $artikel->user ?></a>
            </li>
            <li><i class="glyphicon glyphicon-tags"></i> On <a href="<?= url('c/' . $artikel->kategori_alias) ?>"
                                                               class="hover-text-theme"><?= $artikel->kategori ?></a>
            </li>
            <li class="hidden-sm"><i
                        class="glyphicon glyphicon-calendar"></i> <?= date("d-m-Y", strtotime($artikel->date)) ?></li>
        </ul>
    </div>
</div>
<ul class="pagination pagination-blog pagination-single-blog">
    <?php
    $sql = new LandaDb();
    $terkait = $sql->findAll("select * from artikel where m_kategori_id = '" . $artikel->m_kategori_id . "' and id != '" . $artikel->id . "' and publish = 1 limit 4");
    $sebelumnya = $sql->find("select * from artikel where m_kategori_id = '" . $artikel->m_kategori_id . "' and id < '" . $artikel->id . "' and publish = 1 order by id DESC");
    $selanjutnya = $sql->find("select * from artikel where m_kategori_id = '" . $artikel->m_kategori_id . "' and id > '" . $artikel->id . "' and publish = 1 order by id ASC");
    if (!empty($sebelumnya)) {
        echo '<li style="float:left"><a href="' . url('d/' . $sebelumnya->alias) . '">« <span class="hidden-sm">Artikel</span> Sebelumnya</a></li>';
    }

    if (!empty($selanjutnya)) {
        echo '<li><a href="' . url('d/' . $selanjutnya->alias) . '"><span class="hidden-sm">Artikel</span> Selanjutnya »</a></li>';
    }

    ?>
</ul>
<div class="relate-post">
    <h3 class="text-cap">Artikel Terkait</h3>
    <hr>
    <div class="relate-blog-warp">
        <?php
        if (empty($terkait)) {
            echo '<blockquote class="quote-1" style="padding-left:50px;">Tidak ada artikel terkait.</blockquote>';
        } else {
            foreach ($terkait as $val) {
                ?>
                <div class="col-md-6 col-sm-12 nopadding">
                    <div class="mobile_thumbnail">
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
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<div class="comment">
    <h3 class="text-cap">Komentar</h3>
    <hr>
    <div class="fb-comments" data-href="<?= url('d/' . $artikel->alias) ?>" dat-width="100%" data-numposts="5"></div>
</div>
