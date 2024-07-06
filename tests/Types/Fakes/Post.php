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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Tests\Types\Fakes\User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query the categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\Tests\Types\Fakes\Category, $this>
     */
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Query the media.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Tests\Types\Fakes\Media, $this>
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
