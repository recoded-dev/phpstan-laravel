<?php

declare(strict_types=1);

namespace Tests\Types\Fakes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
