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

    public function createCSVFile($data)
    {
        if($this->fileManager->ifFileExist('paymentdays.csv') === false) {
            $fp = fopen("../public/paymentdays.csv", 'w');
            $paymentDays = $data->getAllPaymentDays();
            foreach ($paymentDays as $paymentDay) {
                $list = [$paymentDay['month'], $paymentDay['nameDay'], $paymentDay['numDay']];
                fputcsv($fp, $list);
            }

            fclose($fp);
            return true;
        }
        return false;
    }
}