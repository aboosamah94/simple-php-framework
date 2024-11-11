<?php
namespace App\Core;

class Security
{
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    public static function protectInput($data)
    {
        return trim($data);
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
