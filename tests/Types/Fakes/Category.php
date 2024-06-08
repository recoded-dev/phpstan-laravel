<?php

declare(strict_types=1);

namespace Tests\Types\Fakes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RuntimeException;

final class Category extends Model
{
    /**
     * Query the posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<self, \Tests\Types\Fakes\Post>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Scope to main categories only.
     *
     * @param \Illuminate\Database\Eloquent\Builder<self> $builder
     * @return void
     */
    public function scopeMain(Builder $builder): void
    {
        //
    }

    /**
     * Scope to main categories only.
     *
     * @param \Illuminate\Database\Eloquent\Builder<self> $builder
     * @return never
     */
    public function scopeMainNever(Builder $builder): never
    {
        throw new RuntimeException('Not implemented');
    }
}
