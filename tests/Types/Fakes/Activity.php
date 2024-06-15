<?php

declare(strict_types=1);

namespace Tests\Types\Fakes;

use Illuminate\Database\Eloquent\Model;
use Tests\Types\Fakes\Collections\ActivityCollection;

final class Activity extends Model
{
    /**
     * @template TKey of array-key
     * @param array<TKey, self> $models
     * @return \Tests\Types\Fakes\Collections\ActivityCollection<TKey>
     */
    public function newCollection(array $models = []): ActivityCollection
    {
        return new ActivityCollection($models);
    }
}
