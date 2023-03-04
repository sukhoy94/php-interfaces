<?php

declare(strict_types=1);

use Andrii\Classes\User;

require __DIR__ . '/vendor/autoload.php';



$user = new User();
$user->hello();
$user->speak();