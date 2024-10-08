<?php

namespace SEVEN_TECH\Gateway\Test;

class Spreadsheet {
    private String $inputFileName;
    private String $sheet;

    public function __construct(String $inputFileName, String $sheet)
    {
        $this->inputFileName = $inputFileName;
        $this->sheet = $sheet;
    }

    public function getSheet() : array {
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($this->inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadEmptyCells(false);
        $reader->setLoadSheetsOnly($this->sheet);
        $spreadsheet = $reader->load($this->inputFileName);
        
        return $spreadsheet->getActiveSheet()->toArray();
    }

    public function getData() : array {
        $array = $this->getSheet();
        unset($array[0]);

        return $array;
    }
}