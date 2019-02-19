<?php

get('/pengguna/index', function() {

    check_access(array('admin' => true));

    //init variable
    $params = $_REQUEST;
    $filter = array();
    $sort = "id DESC";
    $offset = 0;
    $limit = 10;

    //limit & offset pagination
    if (isset($params['limit']))
        $limit = $params['limit'];
    if (isset($params['offset']))
        $offset = $params['offset'];

    //sorting
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
    $sql->select("*")
            ->from('m_user')
            ->limit($limit)
            ->orderBy($sort)
            ->offset($offset);

    //filter
    $where = '';
    if (isset($params['filter'])) {
        $filter = (array) json_decode($params['filter']);
        foreach ($filter as $key => $val) {
            $sql->where('LIKE', $key, $val);
        }
    }

    $models = $sql->findAll();
    $totalItem = $sql->count();
    $sql->clearQuery();

    echo json_encode(array('status' => 1, 'data' => (array) $models, 'totalItems' => $totalItem), JSON_PRETTY_PRINT);
});

post('/pengguna/create', function() {

    check_access(array('admin' => true));

    $params = json_decode(file_get_contents("php://input"), true);

    if (cek_user($params) === true) {
        $data = $params;
        $data['email'] = $params['email'];
        $data['password'] = sha1($data['password']);
        $data['roles_id'] = 1;

        $sql = new LandaDb();
        $model = $sql->insert('m_user', $data);

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_user($params)), JSON_PRETTY_PRINT);
    }
});

post('/pengguna/update/:id', function($id) {

    check_access(array('admin' => true));

    $params = json_decode(file_get_contents("php://input"), true);

    if (cek_user($params) === true) {
        $data = $params;
        $data['email'] = $params['email'];

        if (!empty($params['password'])) {
            $data['password'] = sha1($data['password']);
        } else {
            unset($data['password']);
        }

        $sql = new LandaDb();
        $model = $sql->update('m_user', $data, array('id' => $id));

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_user($params)), JSON_PRETTY_PRINT);
    }
});

post('/pengguna/updateprofile/', function() {

    check_access(array('admin' => true));

    $params = json_decode(file_get_contents("php://input"), true);

    if (cek_user($params) === true) {
        $data = $params;

        if (!empty($params['password'])) {
            $data['password'] = sha1($data['password']);
        } else {
            unset($data['password']);
        }

        $sql = new LandaDb();
        $model = $sql->update('m_user', $data, array('id' => $_SESSION['user']['id']));

        if ($model) {
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => 'Data gagal disimpan'), JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_user($params)), JSON_PRETTY_PRINT);
    }
});

get('/pengguna/view/:id', function($id) {

    check_access(array('admin' => true));

    $sql = new LandaDb();
    $model = $sql->find("select * from m_user where id=$id");
    unset($model->password);
    echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);
});

get('/pengguna/profile', function() {

    check_access(array('admin' => true));

    $id = $_SESSION['user']['id'];
    $sql = new LandaDb();
    $model = $sql->find("select * from m_user where id = $id ");
    unset($model->password);

    echo json_encode(array('status' => 1, 'data' => $model), JSON_PRETTY_PRINT);
});

del('/pengguna/delete/:id', function($id) {

    check_access(array('admin' => true));

    $sql = new LandaDb();
    $model = $sql->delete('m_user', array('id' => $id));
    echo json_encode(array('status' => 1));
});

get('/pengguna/roles', function() {
    $sql = new LandaDb();
    $get = $sql->findAll("select * from m_roles");
    echo json_encode(array("data" => $get));
});
