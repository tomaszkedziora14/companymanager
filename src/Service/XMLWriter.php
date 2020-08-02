<?php


namespace App\Service;

use App\Manager\FileManager;
use App\Service\StrategyWriterInterface;

class XMLWriter implements StrategyWriterInterface
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function createFile($data)
    {
        // TODO: Implement createFile() method.
    }
}