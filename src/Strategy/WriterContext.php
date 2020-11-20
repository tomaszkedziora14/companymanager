<?php

namespace App\Strategy;

use App\Service\CsvWriter;
use App\Manager\FileManager;
use App\Service\WriterInterface;

class WriterContext
{
    private $writer;

    public function setWriter(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public function getWriter()
    {
        return  $this->writer;
    }
}
