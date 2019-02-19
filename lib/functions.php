<?php

/* product */

function getSetting()
{
    $sql = new LandaDb();
    $setting = $sql->find("select * from m_web_setting where id = 1");

    return $setting;
}

function facebook_connect()
{
    return array('appId' => '825402027535189', 'secret' => '4540ca279550c32c25e168b7e3e0a1a9');
}

function get_images($html)
{
    preg_match_all('@src="([^"]+)"@' , $html, $match);

    $src = array_pop($match);

    return $src;
}

function get_gallery_src($html)
{
    $post_html = str_get_html($html);
    $img = $post_html->find('img');
    $image = array();
    if (!empty($img)) {
        foreach ($img as $val) {
            $image[] = $val->src;
        }
    }
    return $image;
}

function get_first_image($html, $size, $class = null, $type = null)
{
    if (empty($class))
        $class = 'img img-responsive';
    else
        $class = $class;

    $post_html = str_get_html($html);

    $first_img = $post_html->find('img', 0);

//    $first_img->src = str_replace("http://","https://",$first_img->src);
    if ($first_img !== null) {
        if ($size == "small") {
            $first_img->src = str_replace('-700x700-', '-150x150-', $first_img->src);
        }

        if ($size == "medium") {
            $first_img->src = str_replace('-700x700-', '-350x350-', $first_img->src);
        }

        if ($size == "big") {
            $first_img->src = $first_img->src;
        }

        if ($type == null)
            return '<img src="' . $first_img->src . '" class="' . $class . '">';
        else
            return $first_img->src;
    } else {
        if ($type == null)
            return '<img src="' . site_url() . 'app/img/system/350x350-noimage.jpg" class="' . $class . '">';
        else
            return site_url() . "app/img/system/350x350-noimage.jpg";
    }
}

function getString($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function isNew($tanggal)
{
    $tgl_created = date("Y-m-d", strtotime
    ($tanggal));
    $tgl = date("Y-m-d");
    $awal = new DateTime($tgl);
    $akhir = $awal->modify('-7 day');
    $akhir = new DateTime($tgl);
    $akhir = $akhir->modify('+1 day');

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($awal, $interval, $akhir);

    $arr_tgl = [];
    foreach ($daterange as $val) {
        $arr_tgl[] = $val->format("Y-m-d");
    }

    return (in_array($tgl_created, $arr_tgl)) ? 1 : 0;
}

function addHits($id)
{
    $sql = new LandaDb();
    $sql->run('UPDATE artikel SET hits = hits+1 WHERE id = ' . $id);
}

function cuplikan($str, $panjang)
{
    return substr(strip_tags($str), 0, $panjang) . '...';
}

function cuplikanvisi($str, $panjang)
{
    return substr(strip_tags($str), 0, $panjang) . '';
}

function rmImg($str)
{
    return preg_replace('/<img.*?>/', '', $str, 1);
}
