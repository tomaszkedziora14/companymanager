<?php

namespace App\Service;

use App\Strategy\WriterInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XlsxWriter implements WriterInterface
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

        $writer = new Xlsx($spreadsheet);
        $writer->save('paymentdays.xlsx');
    }
}
