<?php

declare(strict_types=1);


namespace Andrii\Classes;


use Andrii\Interfaces\HelloInterface;

class User implements HelloInterface
{    
    public function hello()
    {
        echo 'Hello';
    }
    
    public function speak(): void
    {
        echo 'Speak Hello';
    }
    
    public function write(): void
    {
        echo 'Write Hello';
    }
}