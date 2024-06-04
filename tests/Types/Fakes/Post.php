<?php

declare(strict_types=1);

namespace Tests\Types\Fakes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Post extends Model
{
    /**
     * Query the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<self, \Tests\Types\Fakes\User>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<self, \Tests\Types\Fakes\Category>
     */
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Query the media.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<self, \Tests\Types\Fakes\Media>
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
