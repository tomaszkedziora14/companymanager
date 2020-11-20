<?php

namespace App\Strategy;

use App\Strategy\WriterInterface;

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
