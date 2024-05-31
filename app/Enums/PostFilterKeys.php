<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class PostFilterKeys extends Enum
{
    private const TITLE = 'title';
    private const CONTENT = 'content';
    private const DESCRIPTION = 'description';
    private const STATUS = 'status';
    private const CATEGORIES = 'categories';
    private const CATEGORY_TITLE = 'category_title';
    private const CREATED_AT_FROM = 'created_at_from';
    private const CREATED_AT_TO = 'created_at_to';
    private const PROFILE_ID = 'profile_id';
    private const VIEWS = 'views';
}
