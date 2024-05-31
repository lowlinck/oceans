<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Enums\PostFilterKeys;

abstract class AbstractFilter
{
    protected array $keys;

    public function __construct()
    {
        $this->keys = $this->filterKeys();
    }
    abstract protected function filterKeys(): array;
    public function apply(Builder $builder, array $data): Builder
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])) {
                $method = Str::camel($key);
                if (method_exists($this, $method)) {
                    $this->$method($builder, $data[$key]);
                }
            }
        }
        return $builder;
    }
}
