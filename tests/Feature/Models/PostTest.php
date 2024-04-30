<?php

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('has published method', function () {
    Post::factory()->create();
    Post::factory()->published(now()->addMinute())->create();

    expect(Post::published()->get())->toHaveCount(0);

    Post::factory()->published(now())->create();
    expect(Post::published()->get())->toBeInstanceOf(Collection::class)->toHaveCount(1);
});

it('has orderByMostRecent method', function () {
    $first = Post::factory()->published(now())->create(['created_at' => now()->subMinute()]);
    $second = Post::factory()->published(now()->subMinute())->create(['created_at' => now()]);

    expect(Post::orderByMostRecent()->get())
        ->pluck('id')->toMatchArray([$first->id, $second->id])
        ->and(Post::orderByMostRecent('created_at')->get())
        ->pluck('id')->toMatchArray([$second->id, $first->id]);
});
