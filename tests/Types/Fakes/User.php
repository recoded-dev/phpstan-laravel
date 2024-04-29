<?php

declare(strict_types=1);

namespace Tests\Types\Fakes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class User extends Model
{
    /**
     * Query the posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<self, \Tests\Types\Fakes\Post>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder<self> $builder
     * @param bool $blocked
     * @return \Illuminate\Database\Eloquent\Builder<self>
     */
    public function scopeBlocked(Builder $builder, bool $blocked = true): Builder
    {
        return $builder->where('blocked', $blocked);
    }
}
