<?php

namespace App\Service;

use App\Strategy\WriterInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CsvWriter implements WriterInterface
{
    public function createFile($data)
    {
        $tbl = $data->getAllPaymentDays();
        $headers = $data->getHeaders();

        array_unshift($tbl, $headers);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray($tbl,
            NULL,
            'A1');

            $writer = new Csv($spreadsheet);
            $writer->setUseBOM(true);
            $writer->setDelimiter(";");
            $writer->setEnclosure(' ');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save('paymentdays.csv');
    }
}
