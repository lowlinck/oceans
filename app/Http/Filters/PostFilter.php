<?php

namespace App\Http\Filters;

use App\Enums\CommentFilterKeys;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\PostFilterKeys;

class PostFilter extends AbstractFilter
{
    protected function filterKeys(): array
    {
        return array_map(fn($enum) => $enum->getValue(), PostFilterKeys::values());
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', "%{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function status(Builder $builder, $value)
    {
        $builder->where('status', $value);
    }

    public function categories(Builder $builder, $value)
    {
        $builder->whereHas('categories', function ($query) use ($value) {
            $query->whereIn('id', $value);
        });
    }

    public function categoryTitle(Builder $builder, $value)
    {
        $builder->whereRelation('category', 'title', 'like', "%{$value}%");
    }

    public function createdAtFrom(Builder $builder, $value)
    {
        $builder->where('created_at', '>=', $value);
    }

    public function createdAtTo(Builder $builder, $value)
    {
        $builder->where('created_at', '<=', $value);
    }

    public function profileId(Builder $builder, $value)
    {
        $builder->where('profile_id', $value);
    }

    public function views(Builder $builder, $value)
    {
        $builder->where('views', '>=', $value);
    }
}
