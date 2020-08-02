<?php


namespace App\Manager;


class FileManager
{
    public function ifFileExist($fileName)
    {
        if (file_exists('../public/'.$fileName)) {
            return true;
        }else{
            return false;
        }
    }

}