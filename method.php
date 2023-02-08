<?php


class PeduliDiri
{
    public $filename = "./output/config.txt";
    public function getData($nik)
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
        // echo $myfile = fopen("./output/data-1- " . $nik . ".txt", "w"); //create file
        $file_handle = fopen('./output/data-' . $nik . '.txt', 'r');
        $datas = array();
        while (!feof($file_handle)) {
            // echo fgets($file_handle) . "<br/>";
            $separate = explode("|", fgets($file_handle));
            // echo $separate[0];
            // if (condition) {
            //     # code...
            // }
            if ($separate[0] != '') {
                $clearDataEnd = str_replace("\r", "", $separate[3]);
                $clearDataFinal = str_replace("\n", "", $clearDataEnd);
                $datas[] = [
                    'tanggal' => $separate[0],
                    'waktu' => $separate[1],
                    'lokasi' => $separate[2],
                    'suhu' => $clearDataFinal
                ];
            }
            // $datas[] = fgets($file_handle);
        }
        fclose($file_handle);

        // print_r($datas);
        // usort($datas, function ($a, $b) {
        //     return $a['suhu'] <=> $b['suhu'];
        // });


        echo json_encode($datas);
        return;


    }

    public function daftar($nik, $nama_lengkap)
    {
        // $text = $nik . "|" . $nama_lengkap . "\n";

        // //check if nik sudah terdaftar
        // $file_handle = fopen($this->filename, 'r');
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
        //check dulu apakah nik sudah ada atau belum
        $file_handle = fopen($this->filename, 'r');
        $status = "";
        while (!feof($file_handle)) {
            $pisah = explode("|", fgets($file_handle));
            if ($pisah[0] == $nik) {
                //nik nya sama, tidak boleh daftar lagi
                header('Content-Type: application/json');
                $status = "NIK Sudah Terdaftar!";
                $data = [
                    'status' => $status
                ];
                echo json_encode($data);
                return;
            }
        }

        //write text ke file
        $text = $nik . "|" . $nama_lengkap . "\n";
        //simpan data
        $file_handle = fopen($this->filename, 'a+');
        fwrite($file_handle, $text);

        header('Content-Type: application/json');

        $data = [
            'status' => 'Sukses',
            'nik' => $nik,
            'nama_lengkap' => $nama_lengkap
        ];
        echo json_encode($data);
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

    public function isiCatatan($nik, $tanggal, $jam, $lokasi, $suhu)
    {
        //check if ifle exis
        $checkFile = file_exists('./output/data-' . $nik . '.txt');


        //function insert data 
        function saveData($fileName, $tanggal, $jam, $lokasi, $suhu)
        {
            //write text ke file
            $text = $tanggal . "|" . $jam . "|" . $lokasi . "|" . $suhu . "\n";
            //simpan data
            $file_handle = fopen($fileName, 'a+');
            fwrite($file_handle, $text);
            header('Content-Type: application/json');
            $data = [
                'status' => 'Sukses'
            ];
            echo json_encode($data);
        }

        if ($checkFile) {
            // echo "file ada";
            //langsung insert
            $fileName = "./output/data-" . $nik . ".txt";
            saveData($fileName, $tanggal, $jam, $lokasi, $suhu);
        } else {
            // echo "gak ada";
            $createFile = fopen("./output/data-" . $nik . ".txt", "w"); //create file
            $fileName = "./output/data-" . $nik . ".txt";
            saveData($fileName, $tanggal, $jam, $lokasi, $suhu);
        }
    }
    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function sorting($nik, $sort)
    {
        $file_handle = fopen('./output/data-' . $nik . '.txt', 'r');
        $datas = array();
        while (!feof($file_handle)) {
            // echo fgets($file_handle) . "<br/>";
            $separate = explode("|", fgets($file_handle));
            // echo $separate[0];
            // if (condition) {
            //     # code...
            // }
            if ($separate[0] != '') {
                $clearDataEnd = str_replace("\r", "", $separate[3]);
                $clearDataFinal = str_replace("\n", "", $clearDataEnd);
                $datas[] = [
                    'tanggal' => $separate[0],
                    'waktu' => $separate[1],
                    'lokasi' => $separate[2],
                    'suhu' => $clearDataFinal
                ];
            }
            // $datas[] = fgets($file_handle);
        }
        fclose($file_handle);

        // print_r($datas);
        usort($datas, function ($a, $b) use ($sort) {
            return $a[$sort] <=> $b[$sort];
        });


        echo json_encode($datas);
        return;


    }

}

?>