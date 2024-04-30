<?php

namespace App\Models;

use App\Models\Builders\PostBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'body',
        'published_at',
    ];

    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder($query);
    }
}
