<?php

namespace TINHCONG\Controllers;

use TINHCONG\Core\Controller;
use TINHCONG\Config\ExeclDB;
use yidas\phpSpreadsheet\Helper;

class ExcelsController extends Controller
{
    public function index()
    {
        $this->render("index");
    }

    public function readExcel($path, $fileType, $file_name)
    {
        $file_fullname = $file_name;

        $datas =  ExeclDB::getExcel($path, $fileType);

        $array_file_name = explode(".", $file_name);
        if (count($array_file_name) > 1) {
            array_pop($array_file_name);
        }
        $file_name = implode(".", $array_file_name);

        return [
            'data' => $datas,
            'file_name' => $file_name,
            'file_fullname' => $file_fullname
        ];
    }



    public function upload($file)
    {
        $target_dir = "./uploads/source/";
        $target_file = $target_dir . basename($file["excelFile"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $uploadOk = false;

        if ($fileType != "xls" && $fileType != "xlsx") {
            echo "Sorry, only xls, xlsx files are allowed.";
            $uploadOk = false;
        }
        if ($uploadOk) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($file["excelFile"]["tmp_name"], $target_file)) {
                // echo "The file " . htmlspecialchars(basename($file["excelFile"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return $this->readExcel($target_file, $fileType, $file["excelFile"]["name"]);
    }

    public function menu()
    {

        $target_dir = "./uploads/source";
        $files = array_diff(scandir($target_dir), array('.', '..'));

        $d['files'] = $files;
        $this->set($d);
        $this->render("menu", "emtylayout");
    }

    public function menuReadExcel($post)
    {
        $array_file_name = explode(".", $post['filePath']);
        $fileType = "xlsx";
        if (count($array_file_name) > 1) {
            $fileType = end($array_file_name);
            array_pop($array_file_name);
        }

        $target_dir = "./uploads/source/";

        $target_file = $target_dir . $post['filePath'];

        return  $this->readExcel($target_file, $fileType, $post['filePath']);
    }

    public function download($datas = null)
    {
        if (gettype($datas) == 'array') {
            $phpSpreadsheetHelper = \yidas\phpSpreadsheet\Helper::newSpreadsheet();
            foreach ($datas as $key => $value) {
                $phpSpreadsheetHelper->addRow($value);
            }
            $phpSpreadsheetHelper->output('tinh cong');
        }
        return null;
    }
}
