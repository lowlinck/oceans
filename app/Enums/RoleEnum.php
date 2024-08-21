<?php
// Создайте файл в app/Enums/RoleEnum.php
namespace App\Enums;

enum RoleEnum: string {
    case Admin = 'admin';
    case User = 'user';
    case Guest = 'guest';
    case Canceled = 'canceled';
}
