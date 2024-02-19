<?php
namespace App\Enums;

enum RolesEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';
    case PARENT = 'parent';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::TEACHER => 'Teacher',
            static::STUDENT => 'Student',
            static::PARENT => 'Parent'
        };
    }
}