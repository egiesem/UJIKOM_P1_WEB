<?php

// header('Content-Type: application/json; charset=utf-8');
// $host=$_SERVER['HTTP_HOST'];
// $fullurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $fullurl;


require_once "header.php";
require_once "method.php";

// echo $_SERVER['REQUEST_METHOD'];
// echo "hallo";


// $peduliDiri = new PeduliDiri();
// $peduliDiri->getData();

$datas = json_decode(file_get_contents('php://input'), true);
// if (isset($datas['nik']) && isset($datas['nama_lengkap']) && isset($datas['action'])) {
if (isset($datas['action'])) {
    // $nik = $datas['nik'];
    // $nama_lengkap = $datas['nama_lengkap'];
    $action = $datas['action']; //sipakan

    // if ($action == 'daftar') {
    //     $peduliDiri->daftar($nik, $nama_lengkap);
    // } elseif ($action == 'login') {
    //     $peduliDiri->login($nik, $nama_lengkap);
    // } //dan lain lain
    $peduliDiri = new PeduliDiri();
    if ($datas['action'] == 'daftar') {
        // $peduliDiri->daftar($peduliDiri->clean($datas['nik']), $peduliDiri->clean($datas['nama_lengkap']));
        $peduliDiri->daftar($peduliDiri->clean($datas['nik']), $datas['nama_lengkap']);
    } elseif ($datas['action'] == 'login') {
        // $peduliDiri->login($peduliDiri->clean($datas['nik']), $peduliDiri->clean($datas['nama_lengkap']));
        $peduliDiri->login($peduliDiri->clean($datas['nik']), $datas['nama_lengkap']);
    } elseif ($datas['action'] == 'getCatatan') {
        $peduliDiri->getData($datas['nik']);
    } elseif ($datas['action'] == 'isiCatatan') {
        $peduliDiri->isiCatatan($datas['nik'], $datas['tanggal'], $datas['jam'], $datas['lokasi'], $datas['suhu']);
    }
}





// echo $_POST['nik'];

// $data = json_decode(file_get_contents('php://input'), true);

// print_r($data['nik']);


// $data = json_decode(file_get_contents('php://input'), true);

// var_dump($_REQUEST);

// echo $_POST['nama_lengkap'];
// var_dump($_POST); 
// // var_dump($_REQUEST); 
// echo $_POST['nik'];
// echo $_POST['nama_lengkap'];


// var_dump($_GET ); 
