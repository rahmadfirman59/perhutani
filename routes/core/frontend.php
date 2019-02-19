<?php

get('/index', function () {
    $sql     = new LandaDb();
    $sql2     = new LandaDb();
    $welcome = $sql->find("select * from artikel where m_kategori_id = 1 and publish = 1");
    $sejarah = $sql->find("select * from artikel where m_kategori_id = 3 and publish = 1");
    $visimisi = $sql->findAll("select * from artikel where m_kategori_id = 11 and publish = 1  limit 4");
    $terbaru = $sql->findAll("select artikel.*, m_kategori.name as kategori, m_user.nama as user from artikel left join m_user on m_user.id = artikel.created_user_id left join m_kategori on m_kategori.id = artikel.m_kategori_id where m_kategori_id in (4,5,7,8,9) and publish = 1 order by artikel.date DESC limit 4");
    $populer = $sql->findAll("select * from artikel where m_kategori_id in (4,5,7,8,9) and publish = 1 order by hits DESC limit 8");
    $fasilitas = $sql->findAll("select * from artikel where m_kategori_id = 12");
    $pelatihan = $sql->findAll("select * from artikel where m_kategori_id = 13 limit 3");
//    echo json_encode(getSetting());
//    exit();

    render('home', ['welcome' => $welcome,
        'sejarah'                 => $sejarah,
        'terbaru'                 => $terbaru,
        'populer'                 => $populer,
        'visimisi'                => $visimisi,
        'fasilitas'               => $fasilitas,
        'pelatihan'               => $pelatihan,
        '_title'     => config('blog.title'),
        '_deskripsi' => config('blog.description'),
        '_keyword'=>config('blog.title'),
        'setting' => getSetting()
        ], 'mainSingle');
});

get('/profil.html', function () {
    $sql    = new LandaDb();
    $profil = $sql->find("select * from artikel where m_kategori_id = 3 and publish = 1");

    $title      = 'Profil Glintung Go Green';
    $breadcrumb = array(
        $title => "#",
    );
    render('profil', [
        'profil'     => $profil,
        'title'      => $title,
        'breadcrumb' => $breadcrumb,
        '_title'     => 'Profil Glintung Go Green',
        '_deskripsi' => 'Gerakan 3G dimulai dengan kegiatan sederhana, yaitu penghijauan lingkungan yang diluncurkan pada bulan Pebruari 2012. Gerakan ini sekaligus mendukung program Pemerintah Kota Malang dalam melakukan gerakan penghijauan Malang Ijo Royo-royo.',
        '_keyword'=>config('blog.title'),
        'setting' => getSetting()
    ], 'main');
});

get('/kunjungan.html', function () {
    $sql    = new LandaDb();
    $kunjungan = $sql->find("select * from artikel where m_kategori_id = 10 and publish = 1");

    $title      = 'Tata Cara Berkunjung Ke Glintung Go Green';
    $breadcrumb = array(
        $title => "#",
    );
    render('profil', [
        'profil'     => $kunjungan,
        'title'      => $title,
        'breadcrumb' => $breadcrumb,
        '_title'     => 'Kunjungan Ke Kampung  Glintung Go Green',
        '_deskripsi' => 'Gerakan 3G dimulai dengan kegiatan sederhana, yaitu penghijauan lingkungan yang diluncurkan pada bulan Pebruari 2012. Gerakan ini sekaligus mendukung program Pemerintah Kota Malang dalam melakukan gerakan penghijauan Malang Ijo Royo-royo.',
        '_keyword'=>config('blog.title'),
        'setting' => getSetting()
    ], 'main');
});

get('/c/:alias.html', function ($alias) {
    $sql = new LandaDb();

    $get = $sql->select("artikel.*, m_kategori.name as kategori, m_user.nama as user, m_kategori.alias as kategori_alias")
        ->from("artikel")
        ->join("left join", "m_kategori", "m_kategori.id = artikel.m_kategori_id")
        ->join("left join", "m_user", "m_user.id = artikel.created_user_id")
        ->where("=", "m_kategori.alias", $alias)
        ->andWhere("=", "publish", 1)
        ->orderBy('id DESC');

    $count = $get->count();

    $show   = 7;
    $limit  = $show;
    $offset = isset($_GET['page']) ? ($_GET['page'] * $show) - $show : 0;
    $list   = $get->offset($offset)->limit($limit)->findAll();

    foreach ($list as $key => $val){
        $val->content = str_replace("http", "https", $val->content);
    }

    $title      = ucfirst($alias);
    $breadcrumb = array(
        ucfirst($alias) => "#",
    );

    render('kategori', [
        'show'       => $show,
        'count'      => $count,
        'list'       => $list,
        'kategori'   => $alias,
        '_title'     => $title . ' Glintung Go Green',
        '_deskripsi' => $title . '.'.config('blog.description'),
        '_keyword'   => $title . ' Glintung Go Green',
        'breadcrumb' => $breadcrumb,
        'setting' => getSetting()
    ], 'main');
});

get('/d/:alias.html', function ($alias) {
    $sql     = new LandaDb();
    $article = $sql->find("select artikel.*, m_user.nama as user, m_kategori.alias as kategori_alias, m_kategori.name as kategori from artikel left join m_kategori on m_kategori.id = artikel.m_kategori_id left join m_user on m_user.id = artikel.created_user_id where artikel.alias = '" . $alias . "' and artikel.publish = 1");

    addHits($article->id);

    $title      = $article->title;
    $breadcrumb = array(
        $article->kategori => url('c/' . $article->kategori_alias),
        $article->title    => "#",
    );

    render('detail', [
        'artikel'    => $article,
        '_title'     => $title . ' | Glintung Go Green',
        '_deskripsi' => $article->description,
        '_keyword'   => $article->keyword,
        'title' => $title,
        'breadcrumb' => $breadcrumb,
        'detailBlog' => true,
        'setting' => getSetting()
    ], 'main');
});

get('/kontak.html', function () {
    $sql    = new LandaDb();
    $kontak = $sql->find("select * from m_web_setting");

    $title      = 'Kontak Glintung Go Green';
    $breadcrumb = array(
        $title => "#",
    );
    render('kontak', [
        'data'       => $kontak,
        '_title'     => $title,
        '_deskripsi' => 'Untuk informasi lebih lanjut mengenai glintung go green dan gerakan 3G di kota Malang, anda dapat menghubungi kami di...',
        '_keyword'   => 'kontak glintung go green',
        'breadcrumb' => $breadcrumb,
        'setting' => getSetting()
    ], 'mainSingle');
});

get('/gallery.html', function () {
    $sql  = new LandaDb();
    $foto = $sql->findAll("select * from artikel where m_kategori_id=6 and publish=1");

    $title      = 'Gallery Glintung Go Green';
    $breadcrumb = array(
        $title => "#",
    );

    render('gallery', [
        '_gallery'   => true,
        'foto'       => $foto,
        '_title'     => $title,
        '_deskripsi' => 'Gallery foto kegiatan dan event yang ada di kampung glintung kota Malang',
        '_keyword' => config('blog.title'),
        'breadcrumb' => $breadcrumb,
        'setting' => getSetting()
    ], 'mainSingle');
});

get('/g/:alias.html', function ($alias) {
    $sql  = new LandaDb();
    $foto = $sql->find("select * from artikel where alias='" . $alias . "' and publish=1");

    $title      = $foto->title;
    $breadcrumb = array(
        $title => "#",
    );

    render('gallery_detail', [
        '_gallery'   => true,
        'foto'       => $foto,
        'title'=>$title,
        '_title'     => $title.' | Glintung Go Green',
        '_deskripsi' => $foto->description,
        '_keyword' => $foto->keyword,
        'breadcrumb' => $breadcrumb,
        'setting' => getSetting()
    ], 'mainSingle');
});

get('/search.html', function () {
    $sql = new LandaDb();

    $get = $sql->select("artikel.*, m_kategori.name as kategori, m_user.nama as user, m_kategori.alias as kategori_alias")
        ->from("artikel")
        ->join("left join", "m_kategori", "m_kategori.id = artikel.m_kategori_id")
        ->join("left join", "m_user", "m_user.id = artikel.created_user_id")
        ->customWhere("artikel.title like '%" . $_GET['q'] . "%' and artikel.m_kategori_id in (4,5,7,8,9)");

    $count = $get->count();

    $show   = 7;
    $limit  = $show;
    $offset = isset($_GET['page']) ? ($_GET['page'] * $show) - $show : 0;
    $list   = $get->offset($offset)->limit($limit)->findAll();

    $title      = 'Hasil Pencarian "<b><i>' . $_GET['q'] . '</i></b>"';
    $breadcrumb = array(
        $title => "#",
    );

    render('pencarian', ['count' => $count, 'show' => $show, 'list' => $list, 'title' => $title, 'breadcrumb' => $breadcrumb], 'main');
});
