<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as Test;

class PersonalAccessToken extends Test
{
    protected $connection = 'mysql2';
}