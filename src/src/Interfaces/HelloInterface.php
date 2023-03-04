<?php

namespace Andrii\Interfaces;

interface HelloInterface 
    extends SpeakableInterface, WritebleInterface
{
    public function hello();
}