<?php

namespace TINHCONG\Config;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExeclDB
{
    public static function getExcel($filePath, $fileType = "xlsx")
    {
        $inputFileType = ucfirst($fileType);
        $inputFileName = $filePath;

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Advise the Reader to load all Worksheets  **/
        $reader->setLoadAllSheets();
        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        foreach ($worksheet->getRowIterator() as $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // For 'TRUE', we loop through cells
            //    only when their value is set.
            // If this method is not called,
            //    the default value is 'false'.
            $dataItem = [];
            foreach ($cellIterator as $cell) {
                array_push($dataItem, $cell->getValue());
            }

            $dataItemCheck = array_unique($dataItem);

            if (count($dataItemCheck) > 1 || $dataItemCheck[0] != null) {
                array_push($data, $dataItem);
            }
        }

        return $data;

    }
}
