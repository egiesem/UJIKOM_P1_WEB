<?php


class PeduliDiri
{
    public $filename = "./output/config.txt";
    public function getData()
    {
        // $file_handle = file('./output/config.txt', FILE_IGNORE_NEW_LINES);
        // $file_handle = fopen('./output/config.txt', 'r');
        // while (!feof($file_handle)) {
        //     echo fgets($file_handle) . "<br/>";
        // }
        // fclose($file_handle);
        // echo "hallo get data";
        // // echo $this->data;

        // $file = file($this->filename, FILE_IGNORE_NEW_LINES);
        // foreach ($file as $value) {
        //     echo $value . "<br/>";
        // }

        $file_handle = fopen($this->filename, 'r');
        while (!feof($file_handle)) {
            // echo fgets($file_handle) . "<br/>";
            $separate = explode("|", fgets($file_handle));
            echo $separate[0];
            // if (condition) {
            //     # code...
            // }
        }
        fclose($file_handle);

    }

    public function daftar($nik, $nama_lengkap)
    {
        $text = $nik . "|" . $nama_lengkap . "\n";

        //check if nik sudah terdaftar
        $file_handle = fopen($this->filename, 'r');
        while (!feof($file_handle)) {
            // echo fgets($file_handle) . "<br/>";
            $separate = explode("|", fgets($file_handle));
            if ($separate[0] == $nik) {
                header('Content-Type: application/json');
                echo json_encode('sudah terdaftar');
                return;
            }
        }
        fclose($file_handle);

        //store data
        $file_handle = fopen($this->filename, 'a+');
        fwrite($file_handle, $text);

        header('Content-Type: application/json');
        echo json_encode('success');




    }

    public function login($nik, $nama_lengkap)
    {
        $credential = $nik . "|" . $nama_lengkap;
        header('Content-Type: application/json');
        //check if nik sudah terdaftar
        $file = file($this->filename, FILE_IGNORE_NEW_LINES);
        // if (in_array($credential, $file)) {
        //     echo "ada";
        // } else {
        //     echo "tidak ada";
        // }


        if (stripos(json_encode($file), $credential) !== false) {
            // echo "found mystring";
            $data = ['status' => 'success', 'nik' => $nik, 'nama_lengkap' => $nama_lengkap];
            echo json_encode($data);
        } else {
            echo json_encode('error');
        }



        // while (!feof($file_handle)) {
        //     // echo fgets($file_handle) . "<br/>";
        //     $separate = explode("|", fgets($file_handle));
        //     if ($separate[0] == $nik) {
        //         header('Content-Type: application/json');
        //         echo json_encode('sudah terdaftar');
        //         return;
        //     }
        // }
        // fclose($file_handle);

        // //store data
        // $file_handle = fopen($this->filename, 'a+');
        // fwrite($file_handle, $text);

        // header('Content-Type: application/json');
        // echo json_encode('success');

    }

    public function isiCatatan()
    {

    }
    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}

?>