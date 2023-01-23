<?php

// header('Content-Type: application/json; charset=utf-8');
// $host=$_SERVER['HTTP_HOST'];
// $fullurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $fullurl;


require_once "header.php";
require_once "method.php";

// $peduliDiri = new PeduliDiri();
// $peduliDiri->getData();

$datas = json_decode(file_get_contents('php://input'), true);
if (isset($datas['nik']) && isset($datas['nama_lengkap']) && isset($datas['action'])) {
    $peduliDiri = new PeduliDiri();
    if ($datas['action'] == 'daftar') {
        $peduliDiri->daftar($peduliDiri->clean($datas['nik']), $peduliDiri->clean($datas['nama_lengkap']));
    } elseif ($datas['action'] == 'login') {
        $peduliDiri->login($peduliDiri->clean($datas['nik']), $peduliDiri->clean($datas['nama_lengkap']));
    }
}



// echo $_POST['nik'];

$data = json_decode(file_get_contents('php://input'), true);

// print_r($data['nik']);


// $data = json_decode(file_get_contents('php://input'), true);

// var_dump($_REQUEST);

// echo $_POST['nama_lengkap'];
// var_dump($_POST); 
// // var_dump($_REQUEST); 
// echo $_POST['nik'];
// echo $_POST['nama_lengkap'];


// var_dump($_GET ); 
