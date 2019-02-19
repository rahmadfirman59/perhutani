<?php

get('/appartikel/kategori', function() {
    check_access(array('login' => true));

    $sql = new LandaDb();
    $models = $sql->findAll("select * from m_kategori");
    echo json_encode(array('status' => 1, 'kategori' => (array) $models));
});

del('/appartikel/delete/:id', function($id) {
    check_access(array('login' => true));

    $sql = new LandaDb();
    $sql->delete('artikel', array('id' => $id));
    echo json_encode(array('status' => 1));
});

post('/appartikel/update/:id', function($id) {
    check_access(array('login' => true));

    $params = json_decode(file_get_contents("php://input"), true);
    $params['date'] = !empty($params['date']) ? date("Y-m-d H:i:s", strtotime($params['date'])) : date("Y-m-d H:i:s", strtotime($params['date']));

    if (cek_artikel($params) === true) {
        $sql = new LandaDb();
        $params['alias'] = urlParsing($params['title']);
        $model = $sql->update('artikel', $params, array('id' => $id));

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_artikel($params)), JSON_PRETTY_PRINT);
    }
});

post('/appartikel/create', function() {
    check_access(array('login' => true));

    $params = json_decode(file_get_contents("php://input"), true);
    $params['date'] = empty($params['date']) ? $params['date'] : date("Y-m-d", strtotime($params['date']));

    if (cek_artikel($params) === true) {
        $sql = new LandaDb();
        $params['alias'] = urlParsing($params['title']);
        $model = $sql->insert('artikel', $params);

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_artikel($params)), JSON_PRETTY_PRINT);
    }
});
get('/appartikel/index', function () {
    check_access(array('login' => true));

    $params = $_REQUEST;
    $filter = array();
    $sort = "artikel.date DESC";
    $offset = 0;
    $limit = 10;

    if (isset($params['limit']))
        $limit = $params['limit'];
    if (isset($params['offset']))
        $offset = $params['offset'];

    if (isset($params['sort'])) {
        $sort = $params['sort'];
        if (isset($params['order'])) {
            if ($params['order'] == "false")
                $sort.=" ASC";
            else
                $sort.=" DESC";
        }
    }

    $sql = new LandaDb();
    $sql->select("artikel.*, m_kategori.name, m_user.nama as penulis")
            ->from('artikel')
            ->join('JOIN', 'm_kategori', 'm_kategori.id = artikel.m_kategori_id')
            ->join('JOIN', 'm_user', 'm_user.id = artikel.created_user_id')
            ->limit($limit)
            ->offset($offset)
            ->orderBy($sort);

    if (isset($params['filter'])) {
        $filter = (array) json_decode($params['filter']);
        foreach ($filter as $key => $val) {
            $sql->where('LIKE', $key, $val);
        }
    }

    $model = $sql->findAll();
    $totalItem = $sql->count();
    $sql->clearQuery();

    if (!empty($model)) {
        $data = array();
        $i = 0;
        foreach ($model as $val) {
            $data[$i] = (array) $val;
            $data[$i]['id'] = $val->id;
            $data[$i]['title'] = $val->title;
            $data[$i]['category_name'] = $val->name;
            $data[$i]['hits'] = $val->hits;
            $data[$i]['tanggal'] = date('d/m/Y', strtotime($val->date));
            $data[$i]['time'] = date('H:i', strtotime($val->created));
//            $data[$i]['created'] = strtotime($val->created);

            if ($val->publish == "1") {
                $data[$i]['status_publish'] = "Publish";
            } else {
                $data[$i]['status_publish'] = "Unpublish";
            }
            $i++;
        }
        echo json_encode(array('status' => 1, 'data' => array_filter($data), 'totalItems' => $totalItem), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => ""), JSON_PRETTY_PRINT);
    }
});
