<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected static string $table = 'auth_user';

    public static function findByUsername(string $username): ?static
    {
        return static::first('SELECT * FROM auth_user WHERE username = ? LIMIT 1', [$username]);
    }
}
