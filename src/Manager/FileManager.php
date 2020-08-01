<?php


namespace App\Manager;

use Symfony\Component\Finder\Finder;

class FileManager
{
    private $finder;

    public function __construct()
    {
        $this->finder = new Finder;
    }

    public function ifFileExist($fileName)
    {
        if (file_exists('../public/'.$fileName)) {
            return true;
        }else{
            return false;
        }
    }

}