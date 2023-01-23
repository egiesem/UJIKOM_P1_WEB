<?php


class PeduliDiri
{
    public function getData()
    {
        // $file_handle = file('./output/config.txt', FILE_IGNORE_NEW_LINES);
        $file_handle = fopen('./output/config.txt', 'r');
        while (!feof($file_handle)) {
            echo fgets($file_handle) . "<br/>";
        }
        fclose($file_handle);
        echo "hallo get data";
        // echo $this->data;

    }

    public function daftar($text)
    {

        $file_handle = fopen('./output/config.txt', 'a+');
        fwrite($file_handle, $text);

        // header('Content-Type: application/json');
        // echo json_encode('success');




    }

    public function login()
    {

    }

    public function isiCatatan()
    {

    }

}

?>