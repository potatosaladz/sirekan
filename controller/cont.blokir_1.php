<?php

function __autoload($class_name) {
    include '../class/class.' . strtolower($class_name) . '.php';
}

if (!isset($_REQUEST['aksi'])) {
    if(!isset($_GET['hal'])) {
        $page=0;
    } else {
        $page=$_GET['hal']-1;
    }
    
    $users = User::getAllUserWithPage($page);
    
    $alluser=User::getAllUser();
    $jml_user=count($alluser);
    $data['jml']=$jml_user/5;
    $data['page']=$page+1;
    $data['user'] = array();
    
    $i = 0;
    $blokir = new Blokir();
    foreach ($users as $rows) {
        $arr[$i] = array(
            'kddept' => $rows['kddept'],
            'kdunit' => $rows['kdunit'],
            'kdsatker' => $rows['kdsatker'],
        );
        $satker[$i] = new Satker($arr[$i]);
        $res[$i] = $satker[$i]->getSatker();
        $isBlokir = $blokir->isBlokir($rows['id_user']) ? 'Blokir' : 'Aktif';
        $data['user'][$i] = array(
            'id_user' => $rows['id_user'],
            'kddept' => $rows['kddept'],
            'kdunit' => $rows['kdunit'],
            'kdsatker' => $rows['kdsatker'],
            'username' => $rows['username'],
            'nmakses' => $rows['nmakses'],
            'nmsatker' => $res[$i]['nmsatker'],
            'status_blokir' => $isBlokir,
        );
        $i++;
    }
    echo json_encode($data);
}
if (isset($_REQUEST['aksi'])) {
    switch (@$_REQUEST['aksi']) {
        case 'cari' :
            if (isset($_REQUEST['filter'])) {
                $users = User::getAllUser();
            } else {
                $users = User::cariUser($_REQUEST['kata']);
            }

            $data[] = array();
            $hasil[] = array();
            $i = 0;
            $blokir = new Blokir();
            foreach ($users as $rows) {
                $arr[$i] = array(
                    'kddept' => $rows['kddept'],
                    'kdunit' => $rows['kdunit'],
                    'kdsatker' => $rows['kdsatker'],
                );
                $satker[$i] = new Satker($arr[$i]);
                $res[$i] = $satker[$i]->getSatker();
                $isBlokir = $blokir->isBlokir($rows['id_user']) ? 'Blokir' : 'Aktif';
                $hasil[$i] = array(
                    'id_user' => $rows['id_user'],
                    'kddept' => $rows['kddept'],
                    'kdunit' => $rows['kdunit'],
                    'kdsatker' => $rows['kdsatker'],
                    'username' => $rows['username'],
                    'nmakses' => $rows['nmakses'],
                    'nmsatker' => $res[$i]['nmsatker'],
                    'status_blokir' => $isBlokir,
                );
                $i++;
            }
            if (isset($_REQUEST['filter'])) {
                $input = $_REQUEST['kata'];
                $k = 0;
                $result = false;
                foreach ($hasil as $item) {
                    //$result = array_filter($item, function ($x) use ($input) {      
                    for ($j = 0; $j < strlen($item['nmsatker']); $j++) {
                        if (stripos(strtolower($input), strtolower(substr($item['nmsatker'], $j, strlen($input)))) !== false) {
                            $result = true;
                        } else {
                            $result = false;
                        }
                    }
                    //  });

                    if ($result) {
                        $data = $hasil[$k];
                    }
                    $k++;
                }
            } else {
                $data = $hasil;
            }

            echo json_encode($data);
            exit;
        case 'ubah' :
            $id_user = $_REQUEST['id_user'];
            $user = User::getUser($id_user);

            $dept = new Dept();
            $nmdept = $dept->getDept($user->kddept);
            $arr = array(
                'kddept' => $user->kddept,
                'kdunit' => $user->kdunit,
            );
            $unit = new Unit($arr);
            $nmunit = $unit->getUnit();
            $arr2 = array(
                'kddept' => $user->kddept,
                'kdunit' => $user->kdunit,
                'kdsatker' => $user->kdsatker,
            );
            $satker = new Satker($arr2);
            $nmsatker = $satker->getSatker();

            $data = array(
                'id_user' => $id_user,
                'username' => $user->username,
                'kddept' => $user->kddept,
                'kdunit' => $user->kdunit,
                'kdsatker' => $user->kdsatker,
                'nmdept' => $nmdept->nmdept,
                'nmunit' => $nmunit->nmunit,
                'nmsatker' => $nmsatker['nmsatker'],
            );

            $blokir = new Blokir();
            $isBlokir = $blokir->isBlokir($id_user);

            if ($isBlokir) {
                $data_blokir = $blokir->getBlokir($id_user);
                $data['is_blokir'] = 'ya';
                $data['id_blokir'] = $data_blokir['id_blokir'];
                $data['tgl_mulai'] = $data_blokir['date_started'];
                $data['tgl_akhir'] = $data_blokir['date_ended'];
                $data['ket_blokir'] = $data_blokir['ket_blokir'];
            } else {
                $data['is_blokir'] = 'no';
            }

            echo json_encode($data);
            exit;
        case 'simpan' :

            $id_user = $_POST['id_user'];
            $date_started = $_POST['tgl_mulai'];
            $date_ended = $_POST['tgl_akhir'];
            $ket_blokir = $_POST['ket_blokir'];

            $arr = array(
                'id_user' => $id_user,
                'date_started' => $date_started,
                'date_ended' => $date_ended,
                'ket_blokir' => $ket_blokir
            );
            $blokir = new Blokir($arr);
            $isBlokir=$blokir->isBlokir($id_user);
            if($isBlokir) {
                $data = array(
                        'msg' => 'no',
                        'info' => 'User sudah diblokir',
                    );
            } else {
                $saveBlokir = $blokir->saveBlokir();
                if ($saveBlokir) {
                    $data = array(
                        'msg' => 'ok',
                        'info' => 'berhasil',
                    );
                } else {
                    $data = array(
                        'msg' => 'no',
                        'info' => 'Gagal blokir user',
                    );
                }
            }
            
            echo json_encode($data);
            exit;
        case 'simpan_ubah' :

            $id_blokir = $_POST['id_blokir'];
            $id_user = $_POST['id_user'];
            $date_started = $_POST['tgl_mulai'];
            $date_ended = $_POST['tgl_akhir'];
            $ket_blokir = $_POST['ket_blokir'];

            $arr = array(
                'id_blokir' => $id_blokir,
                'id_user' => $id_user,
                'date_started' => $date_started,
                'date_ended' => $date_ended,
                'ket_blokir' => $ket_blokir
            );

            $blokir = new Blokir($arr);

            $saveBlokir = $blokir->ubahBlokir();
            if ($saveBlokir) {
                    $data = array(
                        'msg' => 'ok',
                        'info' => 'berhasil',
                    );
            } else {
                $data = array(
                    'msg' => 'no',
                    'info' => 'Gagal simpan data blokir',
                );
            }

            echo json_encode($data);
            exit;
        case 'buka' :
            $id_blokir = $_POST['id_blokir'];
            $blokir = new Blokir();
            $blokir_user = $blokir->bukaBlokir($id_blokir);

            if ($blokir_user) {
                $data = array(
                    'msg' => 'ok',
                    'info' => 'berhasil di buka',
                );
            } else {
                $data = array(
                    'msg' => 'no',
                    'info' => 'Gagal membuka blokir',
                );
            }
            echo json_encode($data);

            exit;
    }
}
?>