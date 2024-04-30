<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{
    public function published(): Builder
    {
        return $this->whereNotNull('published_at')
            ->where('published_at', '<=', now()->toDateTimeString());
    }

    public function orderByMostRecent(string $column = 'published_at'): Builder
    {
        return $this->orderByDesc($column);
    }
}
