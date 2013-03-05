<?php

function __autoload($class_name) {
    include 'class/class.' . strtolower($class_name) . '.php';
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $message = array();
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (empty($user) || empty($pass)) {
        $message[] = "Tidak boleh kosong";
    }


    $data = array(
        'username' => $user,
        'password' => $pass,
    );

    $user = new User($data);

    $cek = $user->cekUser($user);

    if (!$cek['is_true']) {
        $message[] = $cek['message'];
    } else {
        echo 'correct';
    }

    $error = count($message);
    if ($error > 0) {
        for ($i = 0; $i < $error; $i++) {
            echo ucwords($message[$i]);
        }
    }
} else {
    header('Location: ../index.php');
}
?>