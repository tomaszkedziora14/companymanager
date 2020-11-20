<?php

namespace App\Service;

use App\Manager\FileManager;
use App\Service\WriterInterface;

class CsvWriter implements WriterInterface
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function createFile($data)
    {
        if($this->fileManager->ifFileExist('paymentdays.csv') === false) {
            $fp = fopen("../public/paymentdays.csv", 'w');
            fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            fputcsv($fp, $data->getHeaders(), ";");
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
