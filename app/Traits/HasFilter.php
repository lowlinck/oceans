<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\AbstractFilter;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $filterClass = '\\App\\Http\\Filters\\' . class_basename($this) . 'Filter';
        if (class_exists($filterClass)) {
            $filter = new $filterClass();

            return $filter->apply($builder, $data);
        }

        return $builder;
    }
}
