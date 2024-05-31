<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class CommentFilterKeys extends Enum
{
    private const CONTENT = 'content';
    private const PROFILE_ID = 'profile_id';
    private const CREATED_AT_FROM = 'created_at_from';
    private const CREATED_AT_TO = 'created_at_to';
}
