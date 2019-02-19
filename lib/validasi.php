<?php

function cek_validate($data, $validasi) {
    if (!empty($custom)) {
        $validasi = $custom;
    }

    Validator::set_field_name("m_kategori_id", "Kategori");

    $validate = Validator::is_valid($data, $validasi);

    if ($validate === true) {
        return true;
    } else {
        $error = '';
        foreach ($validate as $val) {
            $error .= $val . '<br>';
        }
        return $error;
    }
}

function cek_user($data, $custom = array()) {
    $validasi = array(
        'username' => 'required',
        'nama' => 'required',
//        'roles_id' => 'required'
    );

    $cek = cek_validate($data, $validasi, $custom);
    return $cek;
}

function cek_artikel($data, $custom = array()) {
    $validasi = array(
        'title' => 'required',
        'content' => 'required',
        'publish' => 'required',
        'm_kategori_id' => 'required',
    );

    $cek = cek_validate($data, $validasi, $custom);
    return $cek;
}

function cek_setting($data, $custom = array()) {
    $validasi = array(
        'nama' => 'required',
        'alamat' => 'required',
        'telepon' => 'required',
        'email' => 'required'
    );

    $cek = cek_validate($data, $validasi, $custom);
    return $cek;
}
