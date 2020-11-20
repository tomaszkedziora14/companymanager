<?php

namespace App\Manager;


class FileManager
{
    public function ifFileExist($fileName)
    {
        return file_exists('../public/'.$fileName);
    }

}
