<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Enums\CommentFilterKeys;



class CommentFilter extends AbstractFilter
{

    protected function filterKeys(): array
    {
        return array_map(fn($enum) => $enum->getValue(), CommentFilterKeys::values());
    }
    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', "%{$value}%");
    }

    public function profileId(Builder $builder, $value)
    {
        $builder->where('profile_id', $value);
    }

    public function createdAtFrom(Builder $builder, $value)
    {
        $builder->where('created_at', '>=', $value);
    }

    public function createdAtTo(Builder $builder, $value)
    {
        $builder->where('created_at', '<=', $value);
    }
}
