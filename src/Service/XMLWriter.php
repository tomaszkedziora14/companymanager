<?php


namespace App\Service;

use App\Manager\FileManager;

class XMLWriter
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