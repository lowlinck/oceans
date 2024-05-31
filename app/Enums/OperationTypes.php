<?php
namespace App\Enums;

use MyCLabs\Enum\Enum;

class OperationTypes extends Enum
{
private const CREATED = 'created';
private const UPDATED = 'updated';
private const DELETED = 'deleted';
private const RESTORED = 'restored';
private const FORCE_DELETED = 'forceDeleted';
private const DELETING = 'deleted associated data';
private const RESTORING = 'restoring';
}
