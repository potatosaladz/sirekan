<?php

function __autoload($class_name) {
    include '../class/class.' . strtolower($class_name) . '.php';
}

if (isset($_POST['rekon'])) {

    session_start();
    $username = $_SESSION['username'];

    $kdbaes = substr($username, 0, 5);
    $kdsatker = substr($username, 5, 6);
    $ulang = $_POST['rekon'];
    $id_rekon = $_POST['id'];
    $nama_file = $_POST['nama'];
    $kddekon = $_POST['kddekon'];
    if ($id_rekon == '2') {
        $periode = $_POST['periode'];
    }
    //rekon saldo awal

    $rekon = new Rekon();
    if ($id_rekon == '1') {
        $cek = $rekon->cekRekonSA($kdbaes, $kdsatker, $kddekon);
        $ceksp2d = $rekon->cekRekonSASp2d($kdbaes, $kdsatker, $kddekon);
    } else {
        //rekon sakpa
        $cek = $rekon->cekRekonSakpa($kdbaes, $kdsatker, $periode, $kddekon);
        $ceksp2d = $rekon->cekRekonSakpaSp2d($kdbaes, $kdsatker, $periode, $kddekon);
    }
    if (($cek || $ceksp2d) && $ulang == 0) {
        echo json_encode('pernah');
    } else {
        $delete = true;
        $delete_sp2d = true;
        if ($ulang == 1) {
            if ($id_rekon == '1') {
                if($cek && !$ceksp2d){
                    $delete = $rekon->deleteRekonSALokal($kdbaes, $kdsatker, $kddekon);
                }else if(!$cek && $ceksp2d)
                {
                    $delete_sp2d = $rekon->deleteRekonSASp2d($kdbaes, $kdsatker, $kddekon);
                }elseif($cek && $ceksp2d){
                    $delete = $rekon->deleteRekonSALokal($kdbaes, $kdsatker, $kddekon);
                    $delete_sp2d = $rekon->deleteRekonSASp2d($kdbaes, $kdsatker, $kddekon);
                } else {
                    echo json_encode('Data Lama Gagal Dihapus');
                }
            } else {
                if($cek && !$ceksp2d){
                    $delete = $rekon->deleteRekonSakpaLokal($kdbaes, $kdsatker, $periode, $kddekon);
                }else if(!$cek && $ceksp2d){
                    $delete = $rekon->deleteRekonSakpaSp2d($kdbaes, $kdsatker, $periode, $kddekon);
                }else if($cek && $ceksp2d){
                    $delete = $rekon->deleteRekonSakpaLokal($kdbaes, $kdsatker, $periode, $kddekon);
                    $delete = $rekon->deleteRekonSakpaSp2d($kdbaes, $kdsatker, $periode, $kddekon);
                } else {
                    echo json_encode('Data Lama Gagal Dihapus');
                }
            }
            //echo json_encode('rekon normal');
        }
        if ($ulang == 0 && (!$delete && !$delete_sp2d)) {
            echo json_encode('Data Lama Gagal Dihapus');
        } else {
            $adk = new Adk();
            $content = $adk->getAdkFile($nama_file);
            if (count($content) == 0) {
                echo json_encode('File ADK Kosong atau Tidak Ada Transaksi');
            } else {
                if ($id_rekon == '1') {
                    $insert = $rekon->insertAdkGLSA($content);
                    if ($insert) {
                        $data=$rekon->getAdkSA($kdbaes, $kdsatker, $kddekon);
                        $insert2 = $rekon->insertGLSA($data);
                        if ($insert2) {
                            //return hasil
                            echo json_encode('Upload ADK Rekonsiliasi Berhasil, Silahkan Cek Hasil Rekonsiliasi');
                        } else {
                            $rekon->deleteRekonSALokal($kdbaes, $kdsatker, $kddekon);
                            echo json_encode('Gagal Membaca ADK, File Corrupt atau Kosong');
                        }
                    } else {
                        echo json_encode('Data Gagal Dimasukkan ke adk_glsa');
                    }
                } else {
                    $insert = $rekon->insertAdkGLSakpa($content);
                    if ($insert) {
                        $data=$rekon->getAdkSakpa($kdbaes, $kdsatker,$periode, $kddekon);
                        $insert2 = $rekon->insertGLSakpa($data);
                        if ($insert2) {
                            //return hasil
                            echo json_encode('Upload ADK Rekonsiliasi Berhasil, Silahkan Cek Hasil Rekonsiliasi');
                        } else {
                            $rekon->deleteRekonSakpaLokal($kdbaes, $kdsatker, $periode, $kddekon);
                            echo json_encode('Gagal Membaca ADK, File Corrupt atau Kosong');
                        }
                    } else {
                        echo json_encode('Data Gagal Dimasukkan ke adk_glsa');
                    }
                }
            }
        }
    }

    //echo json_encode('Dataneeeee');
}
?>