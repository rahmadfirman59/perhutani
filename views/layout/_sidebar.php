<div class="sidebar-page">
    <div class="widget widget-category">
        <h3>Kategori</h3>
        <?php
        $sql = new LandaDb();
        $kategori = $sql->findAll("SELECT m_kategori.name as kategori, m_kategori.alias, count(artikel.id) as total FROM m_kategori left join artikel ON artikel.m_kategori_id = m_kategori.id WHERE m_kategori.id in (5,14) group by m_kategori.id");
        ?>
        <ul class="category">
            <?php
            foreach ($kategori as $ktg) {
                echo '<li><i class="glyphicon glyphicon-chevron-right"></i>&nbsp;<a href="' . url('c/' . $ktg->alias) . '" class="hover-text-theme">' . $ktg->kategori . '</a><span class="count">' . $ktg->total . '</span></li>';
            }
            ?>
        </ul>
    </div>
    <div class="widget widget-popular">
        <h3>Artikel Populer</h3>
        <?php
        $populer = $sql->findAll("select * from artikel where m_kategori_id in (4,5,6,7,8,9) and publish = 1 order by hits DESC limit 4");
        foreach ($populer as $val) {
            ?>
            <div class="panel panel-custom border-color-theme popular-sidebar">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="<?= url('d/' . $val->alias) ?>"><?= $val->title ?></a>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
//                            $a = str_replace("http", "https", get_first_image($val->content, 'medium', 'img img-thumbnail img-responsive '));
//                            echo $a;
                            $a =get_first_image($val->content, 'medium', 'img img-thumbnail img-responsive ');
                            echo $a;
                            ?>
                        </div>
                    </div>
                    <p class="text-justify"><?= cuplikan($val->content, 200) ?> <a href="<?= url('d/' . $val->alias) ?>">[read more]</a></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
