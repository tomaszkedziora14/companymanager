<?php


namespace App\Service;

use App\Manager\FileManager;

class CsvWriter
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function testCSV()
    {
        $headers = array('Lastname :', 'Firstname :');
        $rows = array(
            array('Doe', 'John'),
            array('Schlüter', 'Rudy'),
            array('Alvarez', 'Niño')
        );

        $file = fopen('file.csv', 'w');
        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        fputcsv($file, $headers, ";");
        foreach ($rows as $row) {
            fputcsv($file, $row, ";");
        }

        fclose($file);
    }

    public function createCSVFile($data)
    {
        if($this->fileManager->ifFileExist('paymentdays.csv') === false) {
            $headers = array('Month', 'Name Day', 'Num Day');
            $fp = fopen("../public/paymentdays.csv", 'w');
            fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            fputcsv($fp, $headers, ";");
            $paymentDays = $data->getAllPaymentDays();
            foreach ($paymentDays as $paymentDay) {
                $list = [$paymentDay['month'], $paymentDay['nameDay'], $paymentDay['numDay']];
                fputcsv($fp,$list,";");
            }

            fclose($fp);
            return true;
        }
        return false;
    }
}