<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\User;

final class DjangoPasswordHasher
{
    public static function check(string $password, string $encoded): bool
    {
        if (!str_starts_with($encoded, 'pbkdf2_sha256$')) {
            return false;
        }

        $parts = explode('$', $encoded);
        if (count($parts) !== 4) {
            return false;
        }

        [, $iterations, $salt, $hash] = $parts;
        $derived = hash_pbkdf2('sha256', $password, $salt, (int) $iterations, 32, true);
        return hash_equals(base64_encode($derived), $hash);
    }
}

final class Auth
{
    private const SESSION_KEY = 'auth_user_id';

    public static function attempt(string $username, string $password): bool
    {
        $user = User::findByUsername($username);
        if (!$user || !$user->is_active) {
            return false;
        }

        if (!DjangoPasswordHasher::check($password, (string) $user->password)) {
            return false;
        }

        Session::set(self::SESSION_KEY, (int) $user->id);
        return true;
    }

    public static function user(): ?User
    {
        $id = Session::get(self::SESSION_KEY);
        return $id ? User::find((int) $id) : null;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            redirect(url('admin_login'));
        }
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? (int) $user->id : null;
    }
}
