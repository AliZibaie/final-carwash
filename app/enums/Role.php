<?php

namespace App\enums;

enum Role: string
{
    case User = 'user';
    case Admin = 'admin';
    case Manager = 'manager';
}
