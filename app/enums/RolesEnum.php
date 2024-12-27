<?php

namespace App\enums;

enum RolesEnum : string
{
    case ADMIN = 'admin';
    case USER = 'user';

    case SUPPLIER = 'supplier';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::USER => 'User',
            self::SUPPLIER => 'Supplier',
        };
    }
}
