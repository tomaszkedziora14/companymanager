<?php


namespace App\Service;


use App\Service\StrategyWriterInterface;
use App\Service\CsvWriter;
use App\Manager\FileManager;

class WriterContext
{
    private $writer;

    public function getWriter($writerType)
    {
        switch ($writerType) {
            case "csv":
                $this->writer = new CsvWriter(new FileManager);
                break;
            case "xml":
            //    $this->writer = new XMLWriter(new FileManager);
                break;
            default:
                throw new \InvalidArgumentException("{$writerType} is not supported");
        }

        return   $this->writer;
    }
}
