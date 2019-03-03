<?php



get('/approles/kategori', function() {
    check_access(array('login' => true));

    $sql = new LandaDb();
    $models = $sql->findAll("select * from m_kategori");
    echo json_encode(array('status' => 1, 'kategori' => (array) $models));
});

del('/approles/delete/:id', function($id) {
    check_access(array('login' => true));

    $sql = new LandaDb();
    $sql->delete('m_roles', array('id' => $id));
    echo json_encode(array('status' => 1));
});


post('/approles/create', function() {
    check_access(array('login' => true));
    $sql = new LandaDb();

    $params = json_decode(file_get_contents("php://input"), true);




        try {
            $params['akses'] = json_encode($params['akses']);
            if (isset($params['id'])) {
                $model = $sql->update('m_roles', $params, ['id' => $params['id']]);
            } else {
                $data['is_deleted'] = 0;
                $model = $sql->insert('m_roles', $params);
            }
            echo json_encode(array('status' => 1, 'data' => (array) $model), JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => cek_artikel($params)), JSON_PRETTY_PRINT);
        }
});
get('/approles/index', function () {
    check_access(array('login' => true));

    $params = $_REQUEST;
    $filter = array();
    $sort = "id DESC";
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
    $sql->select("*")
            ->from('m_roles')

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

        foreach ($model as $key => $value){
            $model[$key] = (array)$value;
            $model[$key]['akses'] = json_decode($value->akses);

        }
        echo json_encode(array('status' => 1, 'data' => array_filter($model), 'totalItems' => $totalItem), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => "Data tidak ada"), JSON_PRETTY_PRINT);
    }
});
